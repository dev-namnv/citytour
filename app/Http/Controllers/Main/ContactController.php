<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\SendContactRequest;
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

    public function store(SendContactRequest $request)
    {
        try {
            //create mail in database
            Contact::create([
                'subject' => $request->get('subject'),
                'full_name' => $request->get('firstName') . '.' . $request->get('lastName'),
                'email' => $request->get('email'),
                'message' => $request->get('messages'),
                'geoip' => $request->ip(),
                'status' => TICKET_OPEN,
            ]);
            //send mail to email admin
            Mail::send('Main.contact.layout_content', $request->all(), function ($msg) use ($request){
                $msg->to(env('MAIL_USERNAME'), 'Admin')
                    ->from($request->email,$request->lastName)
                    ->setSubject($request->subject);
            });
        } catch (\Exception $e) {
            return redirect()->route('contact.index')->with('fails',[]);
        }
        return redirect()->route('contact.index')->with('success',[]);
    }
}
