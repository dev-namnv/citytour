<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function detail($id)
    {
        $invoice = Invoice::find($id);

        if (empty($invoice) || $invoice->user_id != auth()->user()->id) {
            return abort(404);
        }

        return view('Main.invoice.detail', compact(['invoice']));
    }

    public function schedule($id)
    {
        $invoice = Invoice::find($id);

        if (empty($invoice) || $invoice->user_id != auth()->user()->id) {
            return abort(404);
        }

        return view('Main.schedule.detail', compact(['invoice']));
    }

    public function complete($sku)
    {
        $invoice = Invoice::where('sku', '=', $sku)->first();
        if (empty($invoice) || $invoice->user_id != auth()->user()->id) {
            return abort(404);
        }

        $invoice->update([
            'status' => INVOICE_COMPLETE_CONFIRM
        ]);

        session()->flash(TOASTR, json_encode(['status' => TOASTR_SUCCESS, 'title' => 'Xác nhận thành công']));
        return redirect()->back();
    }

}
