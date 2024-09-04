<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    protected function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
                    ? back()->with('status', trans($response))
                    : back()->withErrors(
                        ['email' => trans($response)]
                    );
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function broker()
    {
        return Password::broker();
    }

    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        $request->user()->notify(new CustomResetPasswordNotification(
            $response  // Aquí cambiamos $this->broker()->createToken($request->user()) por $response
        ));

        return back()->with('status', trans($response));
    }
}
