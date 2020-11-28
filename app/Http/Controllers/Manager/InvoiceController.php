<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Scopes\ActiveScope;
use App\Scopes\PublishScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->has('status') ? [$request->status] : array_keys(config('masterdata')['invoice']['status']);
        if (Auth::user()->role === GUIDE) {
            $invoices = Invoice::query()->withoutGlobalScopes()
                ->where('guide_id',Auth::id())
                ->whereIn('status', $status)
                ->orderBy('created_at','DESC')
                ->paginate(PAGINATION_TOUR);
        } else {
            $invoices = Invoice::query()->withoutGlobalScopes()
                ->whereIn('status', $status)
                ->orderBy('created_at','DESC')
                ->paginate(PAGINATION_TOUR);
        }

        return view('Manager.invoices.index', compact('invoices'));
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
}
