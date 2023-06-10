<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new coupon.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store a newly created coupon in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:coupons',
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after:start_date',
            'discount_price' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        Coupon::create($validatedData);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully');
    }

    /**
     * Show the form for editing the specified coupon.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified coupon in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validatedData = $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'start_date' => 'required|date',
            'expiry_date' => 'required|date|after:start_date',
            'discount_price' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        $coupon->update($validatedData);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully');
    }

    /**
     * Remove the specified coupon from the database.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully');
    }
}
