<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mails\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('Contact.index');
    }

    public function store(ContactRequest $request)
    {
        try {
            //send mail to email admin
            Mail::send('Contact.layout_content', $request->all(), function ($msg) use ($request){
                $msg->to(env('MAIL_USERNAME'), 'Admin')
                    ->from($request->email,$request->lastName)
                    ->setSubject($request->title);
            });
            //create mail in database
            $modelContact = new Contact();
            $modelContact->subject = $request->get('title');
            $modelContact->full_name = $request->get('firstName') . '.' . $request->get('lastName');
            $modelContact->email = $request->get('email');
            $modelContact->message = $request->get('content');
            $modelContact->geoip = $request->ip();
            $modelContact->status = 10;
            $modelContact->save();
        } catch (\Exception $e) {
            return redirect()->route('contact.index')->with('fails',[]);
        }
        return redirect()->route('contact.index')->with('success',[]);
    }
}
