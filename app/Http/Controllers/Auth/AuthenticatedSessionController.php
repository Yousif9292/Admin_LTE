<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\VerificationCodeMail;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Check if the user's email is verified
        if (!$request->user()->hasVerifiedEmail()) {
            $emailData = [
                'to' => $request->user()->email,
                'subject' => 'Email Verification',
                'message' => 'Please verify your email address.',
            ];

            // Send the verification email
            Mail::to($emailData['to'])->send(new VerificationCodeMail($emailData));

            // Store the email address in the session
            $request->session()->put('verification_email', $emailData['to']);

            // return redirect()->route('verification_notice');
        }
        // Add a return statement here
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
