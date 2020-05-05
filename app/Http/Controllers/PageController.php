<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about ()
    {
        $title = 'About';

        return view('about', compact('title'));
    }
}
