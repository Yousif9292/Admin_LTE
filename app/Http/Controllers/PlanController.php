<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Session;
use Stripe;
use Stripe\Charge;

class PlanController extends Controller
{



    public function index()
    {
        $plans = Plan::all();

        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stripe_plan' => 'nullable',
            'duration' => 'required',
            'status' => 'required',
            'description' => 'nullable',
        ]);

        Plan::create($validatedData);

        return redirect()->route('plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stripe_plan' => 'nullable',
            'duration' => 'required',
            'status' => 'required',
            'description' => 'nullable',
        ]);

        $plan->update($validatedData);

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plan deleted successfully.');
    }

    public function viewplans()
    {
        $plans = Plan::all();

        return view('plans.show', compact('plans'));
    }

    public function subscribe(Request $request, $plan)
    {
        // Set your Stripe secret key
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Retrieve the selected plan
        $selectedPlan = Plan::find($plan);


        // Create a Stripe charge for the plan's price
        Stripe\Charge::create([
            'amount' => $selectedPlan->price * 100 ,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Subscription payment',
        ]);

     // Retrieve the authenticated user
        $user = auth()->user();

        // Update the subscribed_plans column of the user
        $user->subscribed_plans = $selectedPlan->name;
        $user->save();

        // Redirect the user or show a success message
        return redirect()->back()->with('success', 'Payment successful!');
    }
}
