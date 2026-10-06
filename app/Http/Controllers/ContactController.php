<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::with(['phones', 'mails'])->first();
        return view('contact', compact('contact'));
    }

}

