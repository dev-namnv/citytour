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
    public function index()
    {
        if (Auth::user()->role === GUIDE) {
            $invoices = Invoice::query()->withoutGlobalScopes([ActiveScope::class, PublishScope::class])
                ->with('category','guide')
                ->where('user_id',Auth::id())
                ->where('publish',0)
                ->orderBy('created_at','DESC')
                ->paginate(PAGINATION_TOUR);
        } else {
            $invoices = Invoice::query()->withoutGlobalScopes([ActiveScope::class, PublishScope::class])
                ->with('user','invoice_detail')
                ->orderBy('created_at','DESC')
                ->paginate(PAGINATION_TOUR);
        }
        return view('Manager.invoices.index', compact('invoices'));
    }

    public function show(Request $request)
    {
        $invoice = Invoice::query()->where('sku',$request->sku)
            ->with('invoice_detail','guide','user')
            ->firstOrFail();
//        dd($invoice);
        return view('Manager.invoices.show',compact('invoice'));
    }
}
