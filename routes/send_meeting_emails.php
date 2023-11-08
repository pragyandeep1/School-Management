<?php

require __DIR__.'/vendor/autoload.php'; // Adjust the path if necessary

use App\Mail\JitsiMeetingNotification;
use Illuminate\Support\Facades\Mail;

// Bootstrapping Laravel
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$meetingId = 1; // Replace with the meeting ID you want to send emails for
$meeting = Meeting::find($meetingId); // Replace with your own logic

if ($meeting) {
    $participants = $meeting->participants;

    foreach ($participants as $participant) {
        Mail::to($participant->email)->send(new JitsiMeetingNotification($meeting));
    }

    echo 'Emails sent to participants' . PHP_EOL;
} else {
    echo 'Meeting not found' . PHP_EOL;
}
