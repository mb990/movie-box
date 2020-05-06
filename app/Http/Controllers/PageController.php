<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contact ()
    {
        $title = 'Contact';

        return view('contact', compact('title'));
    }
}
