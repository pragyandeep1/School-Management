<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\OfflinePayment;

class PaymentController extends Controller
{
    public function feeManager(){
        $studentFees = Payment::all(); // Assuming you have a StudentFee model

        return view('admin/payment/fee_manager', compact('studentFees'));
   }
   
    public function storeOfflinePayment(Request $request){
    // Validate the form data
        $request->validate([
            'student_name' => 'required|min:3|max:255', // Change 'student' to 'student_name'
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        // Create a new OfflinePayment record
        OfflinePayment::create([
            'student_name' => $request->input('student_name'), // Use the correct field name
            'amount' => $request->input('amount'),
            'payment_date' => $request->input('payment_date'), // Correct the field name
            'record_type' => '1',
        ]);

        // Redirect back to the form with a success message
        return redirect()->route('offline-payment')->with('success', 'Payment saved successfully');
    }

    public function addOfflinePayment() {
        $offlinePayments = OfflinePayment::all();

        return view('admin.payment.offline_payment', compact('offlinePayments'));
    }

    public function save(Request $request) {
        // Validate and save the student fee
        $request->validate([
            'student_name' => 'required',
            'amount' => 'required|numeric',
        ]);

        Payment::create([
            'student_name' => $request->input('student_name'),
            'amount' => $request->input('amount'),
        ]);

        return redirect()->back()->with('success', 'Student fee created successfully');
    }

    public function savePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        OfflinePayment::create([
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'date' => $request->input('date'),
            'record_type' => 'payment',
        ]);

        return redirect()->route('offline-payment')->with('success', 'Payment saved successfully');
    }

    public function getPaymentCount()
    {
        $paymentCount = OfflinePayment::count();
        return response()->json(['userCount' => $paymentCount]);
    }// end function

}
