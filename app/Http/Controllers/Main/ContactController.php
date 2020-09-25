<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
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
        return view('Main.contact.index');
    }

    public function store(ContactRequest $request)
    {

        try {
            //create mail in database
            Contact::create([
                'subject' => $request->get('title'),
                'full_name' => $request->get('firstName') . '.' . $request->get('lastName'),
                'email' => $request->get('email'),
                'message' => $request->get('content'),
                'geoip' => $request->ip(),
                'status' => 10,
            ]);
            //send mail to email admin
            Mail::send('Main.contact.layout_content', $request->all(), function ($msg) use ($request){
                $msg->to(env('MAIL_USERNAME'), 'Admin')
                    ->from($request->email,$request->lastName)
                    ->setSubject($request->title);
            });
        } catch (\Exception $e) {
            return redirect()->route('contact.index')->with('fails',[]);
        }
        return redirect()->route('contact.index')->with('success',[]);
    }
}
