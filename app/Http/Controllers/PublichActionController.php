<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use Exception;
use Illuminate\Http\Request;

class PublichActionController extends Controller
{
    public function sendContactForm(ContactUsRequest $request)
    {
        try {
            $contact = ContactUs::create($request->all());
            return $this->success('your message was sent successfully', $contact);
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }
}
