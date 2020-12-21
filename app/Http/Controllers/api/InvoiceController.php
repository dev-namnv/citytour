<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function getNewInvoice()
    {
        if (Auth::user()->role === GUIDE){
            $invoices = Invoice::query()->withoutGlobalScopes()
                ->where('guide_id',Auth::id())
                ->where('status', INVOICE_NEW)
                ->with('invoice_detail')
                ->orderBy('created_at','DESC')
                ->get();
        }else{
            $invoices = Invoice::query()->withoutGlobalScopes()
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
    public function list(Request $request)
    {
        // Lấy param query
        $pagination = $request->get('pagination');
        $query = $request->get('query');
        $sort = $request->get('sort');

        // Phân trang mặc định
        $perPage = PAGINATION_INVOICE;
        // Nếu phân trang > 0 và <= 50 thì sẽ lấy giá trị
        if ($request->has('pagination') && (int)$pagination['perpage'] > 0 && (int)$pagination['perpage'] <= 50) {
            $perPage = (int)$pagination['perpage'];
        }

        $docs = Invoice::query()->with('tour', 'guide', 'user', 'batch', 'refund', 'invoice_detail');
        if (Auth::user()->role === GUIDE) { // Nếu là ADMIN đăng nhập
            $docs = $docs->ofGuide();
        }

        // Nếu có sort order
        if ($sort && in_array($sort['sort'], ['asc', 'desc'])) {
            // Lấy giá trị theo field và type sort
            $docs = $docs->orderBy($sort['field'], $sort['sort']);
        } else {
            // Nếu không mặc định sort order theo created_at
            $docs = $docs->orderBy('created_at', 'desc');
        }

        // Kiểm tra tồn tại query thì thêm where
        if ($query) {
            foreach ($query as $key => $q) { // Thực hiện query theo active và publish
                if (in_array($key, ['status']) && isset($q)) {
                    $docs = $docs->where($key, '=', $q);
                }
            }

            // Kiểm tra keyword search tồn tại
            // Search theo: tour name hoặc guide name hoặc batch
            if (!empty($query['keyword']) && $query['keyword']) {
                $docs = $docs
                    ->where('name', 'like', '%'.$query['keyword'].'%')
                    ->orWhereHas('guide', function ($c) use ($query) {
                        $c->where('first_name', 'like',  '%'.$query['keyword'].'%');
                    })
                    ->orWhereHas('batches', function ($c) use ($query) {
                        $c->where('batch', 'like',  '%'.$query['keyword'].'%');
                    });
            }
        }

        $invoices = $docs->paginate($perPage, '*', 'pagination[page]', $pagination['page']);

        return response()->json($invoices);
    }
}
