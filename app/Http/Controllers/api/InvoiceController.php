<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
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
}
