<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\SendContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    /**
     * @param Request $request
     * return List Contacts
     */
    public function index(Request $request)
    {
        $contacts = Contact::query()
            ->where('status','!=',0)
            ->orderBy('id', 'desc')
            ->get();
        return view('Manager.contacts.index',compact('contacts'));
    }



    /**
     * @param $id
     * return Detail contact
     */
    public function show($id)
    {
        $contact = Contact::query()->findOrFail($id);
        $contactReply = Contact::query()->where('reply_for','=',$id)->get();
        return view('Manager.contacts.show',compact('contact','contactReply'));
    }

    /**
     * @param SendContactRequest $request
     * return status reply
     */
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
               'status' => 0,
           ]);
           //send mail to email admin
           Mail::send('Main.contact.layout_content', $request->all(), function ($msg) use ($request){
               $msg->to($request->email, $request->name)
                   ->from(env('MAIL_USERNAME'), 'Admin')
                   ->setSubject($request->subject);
           });
           //update status contact
           Contact::query()->where('id',$request->get('reply_for'))->update(['status'=>TICKET_ANSWERED]);
       } catch (\Exception $e) {
           $message = ['status' => TOASTR_ERROR, 'content' => 'Thất bại','title'=>'Fails'];
           session()->flash(TOASTR, json_encode($message));
           return redirect()->route('contacts.show',$request->get('reply_for'))->with('fails',[]);
       }
       $message = ['status' => TOASTR_SUCCESS, 'content'=>'Thành công' ,'title' => 'Success'];
       session()->flash(TOASTR, json_encode($message));
       return redirect()->route('contacts.show',$request->get('reply_for'))->with('success',[]);
   }

    /**
     * @param Request $request
     * return contacts list
     */
   public function update($id, $status)
   {
       Contact::query()
           ->where('id',$id)
           ->update(['status'=>$status]);
       return redirect()->route('contacts.index');
   }

}
