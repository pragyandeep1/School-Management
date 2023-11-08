<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index()
    {
        return view('word.form');
    }

    public function store(Request $request)
    {
        // Handle the form submission and save the data to the database
    }
}

