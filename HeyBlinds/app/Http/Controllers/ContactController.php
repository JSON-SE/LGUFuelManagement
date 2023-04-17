<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Notifications\AdminContactNotification;
use App\Notifications\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    /**
     * Display contact us page
     *
     * @return View
     */
    public function index()
    {
        return view('frontend.contact-us');
    }
    /**
     * Store the conatact info and sending the email
     *
     * @param Request $request
     *
     * @return back
     */

    public function store(ContactRequest $request)
    {
        $data = Contact::create($request->except('confirm_email'));
    
        Notification::route('mail', $request->email)
            ->notify(new ContactNotification($data));

        Notification::route('mail', ['contact@heyblinds.ca', 'help@heyblinds.ca'])
            ->notify(new AdminContactNotification($data));
            
        return redirect()->back()->with('message', 'Thank you! Your message has been successfully sent.');
    }
}
