<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function getNewInvoice()
    {
        if (Auth::user()->role === GUIDE){
            $invoices = Invoice::query()
                ->where('guide_id',Auth::id())
                ->where('status', INVOICE_NEW)
                ->with('invoice_detail')
                ->orderBy('created_at','DESC')
                ->get();
        }else{
            $invoices = Invoice::query()
                ->where('status', INVOICE_NEW)
                ->with('invoice_detail')
                ->orderBy('created_at','DESC')
                ->get();
        }
        return response(['data'=>$invoices]);
    }

    public function getCustomerTotal(Request $request)
    {
        $tour_id = $request->get('tour_id');
        $start_date = $request->get('start_date');
        $invoices = Invoice::query()->where('tour_id',$tour_id)
            ->where('start_date',$start_date)
            ->get(['adult_count','child_count']);
        $customer_total = $invoices->sum('adult_count') + $invoices->sum('child_count');
        return response(['customer_total'=>$customer_total]);
    }

    /**
     * List tour
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function tours(Request $request)
    {
        // Lấy param query
        $pagination = $request->get('pagination');
        $query = $request->get('query');
        $sort = $request->get('sort');

        // Phân trang mặc định
        $perPage = PAGINATION_TOUR;
        // Nếu phân trang > 0 và <= 50 thì sẽ lấy giá trị
        if ($request->has('pagination') && (int)$pagination['perpage'] > 0 && (int)$pagination['perpage'] <= 50) {
            $perPage = (int)$pagination['perpage'];
        }

        $docs = Tour::query()
            ->with('guide', 'batches', 'schedules', 'invoices')
            ->whereHas('invoices.user', function ($q) {
                $q->orderBy('created_at', 'desc');
            });
        if (Auth::user()->role === GUIDE) {
            $docs = $docs->ofGuide();
        }

        // query theo status
        if (is_array($query) && array_key_exists('status', $query) && $query['status'] != '') {
            $docs = $docs->whereHas('invoices', function ($q) use ($query) {
                $q->where('status', '=', $query['status']);
            });
        }

        // Nếu có sort order
        if ($sort && in_array($sort['sort'], ['asc', 'desc']) && $sort['field'] !== 'status') {
            // Lấy giá trị theo field và type sort
            $docs = $docs->orderBy($sort['field'], $sort['sort']);
        } else {
            // Nếu không mặc định sort order theo created_at
            $docs = $docs->orderBy('created_at', 'desc');
        }

        // Kiểm tra tồn tại query thì thêm where
        if ($query) {
            // Kiểm tra keyword search tồn tại
            // Search theo: tour name
            if (!empty($query['keyword']) && $query['keyword']) {
                $docs = $docs
                    ->where('name', 'like', '%'.$query['keyword'].'%');
            }
        }

        if (!$pagination) {
            $pagination['page'] = 1;
        }
        $tours = $docs->paginate($perPage, '*', 'pagination[page]', $pagination['page']);

        $meta = [
            'page' => $tours->currentPage(),
            'pages' => $tours->lastPage(),
            'perpage' => $tours->perPage(),
            'total' => $tours->total()
        ];

        return response()->json([
            'total' => $tours->total(),
            'per_page' => $tours->perPage(),
            'current_page' => $tours->currentPage(),
            'last_page' => $tours->lastPage(),
            'from' => $tours->firstItem(),
            'to' => $tours->lastItem(),
            'data' => $tours->items(),
            'meta' => $meta
        ]);
    }

    public function listByTour(Request $request, $id)
    {
        $pagination = $request->get('pagination');
        $sort = $request->get('sort');

        $docs = Invoice::query()->where('tour_id', $id)->with('user', 'batch', 'refund', 'invoice_detail');
        if (Auth::user()->role === GUIDE) {
            $docs = $docs->ofGuide();
        }

        // Phân trang mặc định
        $perPage = PAGINATION_INVOICE;
        // Nếu phân trang > 0 và <= 50 thì sẽ lấy giá trị
        if ($request->has('pagination') && (int)$pagination['perpage'] > 0 && (int)$pagination['perpage'] <= 50) {
            $perPage = (int)$pagination['perpage'];
        }

        // Nếu có sort order
        if ($sort && in_array($sort['sort'], ['asc', 'desc'])) {
            // Lấy giá trị theo field và type sort
            $docs = $docs->orderBy($sort['field'], $sort['sort']);
        } else {
            // Nếu không mặc định sort order theo created_at
            $docs = $docs->orderBy('start_date', 'desc');
        }

        if (!$pagination) {
            $pagination['page'] = 1;
        }

        $invoices = $docs->paginate($perPage, '*', 'pagination[page]', $pagination['page']);
        return response()->json($invoices);
    }

    public function weeklyIncome(): JsonResponse
    {
        $invoices = Invoice::query()->where('created_at', '>=', Carbon::parse()->startOfWeek());
        if (\auth()->user()->role === GUIDE) {
            $invoices = $invoices->ofGuide();
        }
        $invoices = $invoices->get();

        $response = [];
        foreach ($invoices as $invoice) {
            array_push($response,
                \auth()->user()->role === ADMIN
                    ? [
                        'money' => $invoice->getRawOriginal('total_cost') * 0.05,
                        'title' => Carbon::parse($invoice->created_at)->format('d/m/Y H:m') . ': ' . Str::limit($invoice->tour->name, 50)
                ]
                    : [
                        'money' => $invoice->getRawOriginal('total_cost'),
                        'title' => Carbon::parse($invoice->created_at)->format('d/m/Y H:m') . ': ' . Str::limit($invoice->tour->name, 50)
                ]
            );
        }

        return response()->json($response);
    }

    public function totalIncome(): JsonResponse
    {
        $invoices = Invoice::query();
        if (\auth()->user()->role === GUIDE) {
            $invoices = $invoices->ofGuide();
        }
        $invoices = $invoices->get();

        $response = [];
        foreach ($invoices as $invoice) {
            array_push($response,
                \auth()->user()->role === ADMIN
                    ? [
                        'money' => $invoice->getRawOriginal('total_cost') * 0.05,
                        'title' => Carbon::parse($invoice->created_at)->format('d/m/Y H:m') . ': ' . Str::limit($invoice->tour->name, 50)
                ]
                    : [
                        'money' => $invoice->getRawOriginal('total_cost'),
                        'title' => Carbon::parse($invoice->created_at)->format('d/m/Y H:m') . ': ' . Str::limit($invoice->tour->name, 50)
                ]
            );
        }

        return response()->json($response);
    }

    public function listUsers(Request $request, $id): JsonResponse
    {
        // Lấy param query
        $pagination = $request->get('pagination');
        $query = $request->get('query');
        $sort = $request->get('sort');
        $batch = $query && $query['batch'] ? $query['batch'] : null;

        // Phân trang mặc định
        $perPage = PAGINATION_TOUR;
        // Nếu phân trang > 0 và <= 50 thì sẽ lấy giá trị
        if ($request->has('pagination') && (int)$pagination['perpage'] > 0 && (int)$pagination['perpage'] <= 50) {
            $perPage = (int)$pagination['perpage'];
        }

        $docs = Invoice::query()
            ->where('tour_id', $id)
            ->where('start_date', $batch)
            ->with('user', 'tour');

        if (auth()->user()->role === GUIDE) {
            $docs = $docs->ofGuide();
        }

        // query theo status
        if (is_array($query) && array_key_exists('status', $query) && $query['status'] != '') {
            $docs = $docs->where('status', '=', $query['status']);
        }

        // Nếu có sort order
        if ($sort && in_array($sort['sort'], ['asc', 'desc']) && $sort['field'] == 'status') {
            // Lấy giá trị theo field và type sort
            $docs = $docs->orderBy($sort['field'], $sort['sort']);
        } else {
            // Nếu không mặc định sort order theo created_at
            $docs = $docs->orderBy('created_at', 'desc');
        }


        // Kiểm tra tồn tại query thì thêm where
        if ($query) {
            // Kiểm tra keyword search tồn tại
            // Search theo: tour name
            if (!empty($query['keyword']) && $query['keyword']) {
                $docs = $docs->whereHas('user', function ($q) use ($query) {
                        $q->where('first_name', 'like', '%'.$query['keyword'].'%')
                            ->whereOr('last_name', 'like', '%'.$query['keyword'].'%')
                            ->whereOr('email', 'like', '%'.$query['keyword'].'%');
                    });
            }
        }

        if (!$pagination) {
            $pagination['page'] = 1;
        }
        $invoices = $docs->paginate($perPage, '*', 'pagination[page]', $pagination['page']);

        $meta = [
            'page' => $invoices->currentPage(),
            'pages' => $invoices->lastPage(),
            'perpage' => $invoices->perPage(),
            'total' => $invoices->total()
        ];

        return response()->json([
            'total' => $invoices->total(),
            'per_page' => $invoices->perPage(),
            'current_page' => $invoices->currentPage(),
            'last_page' => $invoices->lastPage(),
            'from' => $invoices->firstItem(),
            'to' => $invoices->lastItem(),
            'data' => $invoices->items(),
            'meta' => $meta
        ]);
    }
}
