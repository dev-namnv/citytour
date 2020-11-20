<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
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

        return view('Main.faq.index', compact('faqs'));
    }
}
