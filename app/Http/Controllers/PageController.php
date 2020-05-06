<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about ()
    {
        $title = 'Contact';

        return view('contact', compact('title'));
    }
}
