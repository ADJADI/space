<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function index()
    {
        return view('scribe.index');
    }
} 