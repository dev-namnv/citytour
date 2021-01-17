<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Invoice;
use App\Models\Tour;
use App\Scopes\ActiveScope;
use App\Scopes\PublishScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->has('status') ? [$request->status] : array_keys(config('masterdata')['invoice']['status']);
        if (Auth::user()->role === GUIDE) {
            $query = Invoice::query()
                ->where('guide_id',Auth::id())
                ->whereIn('status', $status)
                ->orderBy('id','DESC');
        } else {
            $query = Invoice::query()
                ->whereIn('status', $status)
                ->orderBy('id','DESC');
        }
        $query->with('invoice_detail');
        if ($request->has('date') || $request->has('type')){
            $date = $request->date ?? date('d-m-Y');
            $type = $request->type ?? 'days';
            $invoices = $this->getOnTime($query,$date,$type,PAGINATION_INVOICE);
        }else{
            $invoices = $query->paginate(PAGINATION_INVOICE);
        }
        return view('Manager.invoices.index', compact('invoices'));
    }

    public function list()
    {
        return view('Manager.invoices.list');
    }

    public function show(Request $request)
    {
        if (Auth::user()->role === GUIDE) {
            $invoice = Invoice::query()->where('sku',$request->sku)
                ->where('guide_id',Auth::id())
                ->with('invoice_detail','guide','user')
                ->firstOrFail();
        } else {
            $invoice = Invoice::query()->where('sku',$request->sku)
                ->with('invoice_detail','guide','user')
                ->firstOrFail();
        }
        return view('Manager.invoices.show',compact('invoice'));
    }


    public function schedule($sku)
    {
        $invoice = Invoice::query()->where('sku',$sku)->firstOrFail();
        if (Auth::user()->role != ADMIN && Auth::user()->id != $invoice->guide_id) {
            return abort(404);
        }

        return view('Main.schedule.detail', compact(['invoice']));
    }

    public function updateStatus($sku,$status)
    {
        Invoice::query()->where('sku',$sku)->update(['status' => $status]);
        return redirect()->back();
    }

    public function listUsers(Request $request, $id)
    {
        $currentTour = Tour::query()->findOrFail($id);
        $batch = $request->has('batch')
            ? Batch::query()
                ->where('batch', Carbon::parse($request->get('batch'))->format('Y-m-d'))
                ->first()
            : null;

        $tours = Tour::query();
        if (\auth()->user()->role === GUIDE) {
            $tours = $tours->ofGuide();
        }

        $tours = $tours->get();

        if ($currentTour && $batch) {
            $invoices = Invoice::query()
                ->where('tour_id', $currentTour->id)
                ->whereHas('batch', function ($query) use ($batch) {
                    $query->where('batch', $batch->batch);
                });
        } else {
            $invoices = [];
        }

        return view('Manager.invoices.statistical', compact('tours', 'currentTour', 'batch', 'invoices'));
    }

    public function changeInvoicesStatus(Request $request, $id)
    {
        $tour = Tour::query()->findOrFail($id);
        $invoices = Invoice::where([
            ['tour_id', '=', $id],
            ['start_date', '=', $request->start_date]
        ])->get();

        foreach ($invoices as $invoice) {
            if ($invoice->status + 1 === INVOICE_IN_PROGRESS && Carbon::parse($tour->getStartAtByDate($request->start_date))->isCurrentDay()){
                $invoice->update([
                    'status' => INVOICE_IN_PROGRESS
                ]);
            } elseif ($invoice->status + 1 === INVOICE_COMPLETE && Carbon::parse($tour->getEndAtByDate($request->start_date))->isCurrentDay()) {
                $invoice->update([
                    'status' => INVOICE_COMPLETE
                ]);
            } elseif ($invoice->status + 1 < INVOICE_IN_PROGRESS) {
                $invoice->update([
                    'status' => $invoice->status + 1
                ]);
            } else {
                session()->flash('message_error', 'Không thể cập nhật trạng thái');
            }
        }

        return redirect()->back();
    }
}
