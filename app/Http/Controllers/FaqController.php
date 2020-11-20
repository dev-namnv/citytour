<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::select('*')
            ->orderByDesc('id')
            ->get()
            ->groupBy('title');

        return view('faq.index', compact('faqs'));
    }
}
