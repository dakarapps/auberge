<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactUsMail;

class MailController extends Controller
{
    public function sendContactUsMail($mailData) {         
        return Mail::to('bheemswami808@gmail.com')->send(new ContactUsMail($mailData));
    }
}
