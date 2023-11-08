<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Section;
use App\Models\Student;

class MeetingLinkController extends Controller
{
    public function show()
	{
	    $user = auth()->user(); // Get the authenticated user (student)
	    $section = $user->section; // Get the student's section
	    
	    if ($section) {
	        $meetingLink = $section->meetingLink; // Get the meeting link for the section
	        return view('meeting-link', ['meetingLink' => $meetingLink]);
	    } else {
	        // Handle the case where the student is not assigned to a section
	        return view('no-section-assigned');
	    }
	}

}
