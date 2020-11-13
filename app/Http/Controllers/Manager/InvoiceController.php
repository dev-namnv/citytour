<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === GUIDE) {
            $invoices = Invoice::query()->withoutGlobalScopes()
                ->with('category','guide')
                ->where('user_id',Auth::id())
                ->where('publish',0)
                ->orderBy('created_at','DESC')
                ->paginate(PAGINATION_TOUR);
        } else {
            $invoices = Invoice::query()->withoutGlobalScopes()
                ->with('tour','user','invoice_detail')
                ->orderBy('created_at','DESC')
                ->paginate(PAGINATION_TOUR);
        }
//dd($invoices);
        return view('Manager.invoices.index', compact('invoices'));
    }

}
