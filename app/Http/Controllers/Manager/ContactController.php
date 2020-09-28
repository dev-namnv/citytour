<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\SendContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        $contacts = Contact::orderBy('id', 'desc')->get();
        return view('Manager.contacts.index',compact('contacts'));
    }



    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
//        $contact->status = TICKET_CLOSED;
//        $contact->save();
        return view('Manager.contacts.show',compact('contact'));
    }

   public function reply(SendContactRequest $request)
   {
       try {
           //create mail in database
           Contact::create([
               'reply_for' => $request->get('reply_for'),
               'subject' => $request->get('subject'),
               'full_name' => Auth::user()->username,
               'email' => Auth::user()->email,
               'message' => $request->get('messages'),
               'geoip' => $request->ip(),
               'status' => TICKET_CLOSED,
           ]);
           //send mail to email admin
           Mail::send('Main.contact.layout_content', $request->all(), function ($msg) use ($request){
               $msg->to($request->email, $request->name)
                   ->from(env('MAIL_USERNAME'), 'Admin')
                   ->setSubject($request->subject);
           });
       } catch (\Exception $e) {
           return redirect()->route('contacts.show',$request->get('reply_for'))->with('fails',[]);
       }
       return redirect()->route('contacts.show',$request->get('reply_for'))->with('success',[]);
   }

}
