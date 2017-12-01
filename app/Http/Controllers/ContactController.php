<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'subject' => 'min:4',
            'message' => 'required|min:10',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with([
            'status' => 'Your message has been submited!'
        ]);
    }
}
