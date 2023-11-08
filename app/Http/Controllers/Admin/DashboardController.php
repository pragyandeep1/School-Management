<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OfflinePayment;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function card()
    {
        // Retrieve the necessary data for each card and pass it to the view
        $userCount = User::count(); // Example: Total Users
        $paymentCount = OfflinePayment::count(); 

        if ($paymentCount >= 0) {
            $paymentCountDisplay = $paymentCount;
        } else {
            $paymentCountDisplay = 0;
        }

        $taskCount = Subject::count(); // Example: Task Count
        $percentage = ($taskCount / 100) * 100;

        // Check if taskCount is not negative
        if ($percentage >= 0) {
            $percentageDisplay = $percentage . '%';
        } else {
            $percentageDisplay = 'Error';
        }

        return view('dashboard', [
            'userCount' => $userCount,
            'paymentCount' => $paymentCountDisplay,
            'percentage' => $percentageDisplay,
        ]);
    }
}
