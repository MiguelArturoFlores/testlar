<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use testmiguel\Http\Requests;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return view('contactView');
    }
}
