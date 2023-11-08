<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
}

public function search(Request $request)
{
    $query = $request->input('query');
    // Perform your search logic here, e.g., query the database
    $results = School::where('name', 'LIKE', '%' . $query . '%')->get();

    return response()->json($results);
}