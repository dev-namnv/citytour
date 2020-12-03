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


}
