<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // You should create a view for the password reset email form
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $status = $this->broker()->sendResetLink(
            $this->getSendResetLinkEmailCredentials($request)
        );

        return $status == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($status)
            : $this->sendResetLinkFailedResponse($request, $status);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    protected function getSendResetLinkEmailCredentials(Request $request)
    {
        return $request->only('email');
    }
}
