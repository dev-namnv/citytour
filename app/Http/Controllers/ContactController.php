<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mails\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Contact.index');
    }

    public function store(ContactRequest $request)
    {
        try {
            Mail::send('Contact.layout_content', $request->all(), function ($msg) use ($request){
                $msg->to(env('MAIL_USERNAME'), 'Admin')
                    ->from($request->email,$request->name)
                    ->setSubject($request->title);
            });
        } catch (\Exception $e) {
            return redirect()->route('contact.index')->with('fails',[]);
        }
        return redirect()->route('contact.index')->with('success',[]);
    }
}
