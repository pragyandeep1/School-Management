<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\JitsiMeetingNotification;
use Illuminate\Support\Facades\Mail;

class MeetingController extends Controller
{
    public function sendMeetingEmails($meetingId)
	{
	    $meeting = Meeting::find($meetingId); // Replace with your own logic to fetch the meeting
	    $participants = $meeting->participants;

	    foreach ($participants as $participant) {
	        Mail::to($participant->email)->send(new JitsiMeetingNotification($meeting));
	    }

	    return 'Emails sent to participants';
	}
}
