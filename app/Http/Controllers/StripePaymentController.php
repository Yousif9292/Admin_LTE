<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    public function showPackagePlans()
    {
        return view('/plans');
    }

    public function handlePayment(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        try {
            // Create the user as a Stripe customer
            $user->createAsStripeCustomer();

            // Set the Stripe API key
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create a new Stripe customer
            $customer = $user->createOrGetStripeCustomer();

            // Create a subscription for the customer
            $subscription = $customer->subscriptions()->create([
                'plan' => $request->input('plan'),
                'email' => $user->email,
            ]);

            // Update the user record with subscription details
            $user->update([
                'stripe_id' => $customer->id,
                'stripe_plan' => $request->input('plan'),
                'subscription_status' => 'active',
            ]);

            // Perform any additional registration steps

            // Redirect or return a response
            return redirect()->route('register');
        } catch (CardException $e) {
            // Handle any Stripe API errors related to card processing
            return back()->withError($e->getMessage())->withErrors($e->getMessage());
        }
    }
}
