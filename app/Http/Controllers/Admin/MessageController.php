<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Contact::findOrfail($id);

        return view('admin.messages.show', compact('message'));
    }
}
