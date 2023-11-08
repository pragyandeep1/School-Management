<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parents;
use App\Models\Branch;
use App\Models\Student;

class ParentsController extends Controller
{
    public function index()
    {
        return view('admin/parent/parent_list');
    }
}
