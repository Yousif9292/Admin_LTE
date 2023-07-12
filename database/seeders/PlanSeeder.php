<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $plans = [
            [
                'name' => 'Standard Package',
                'stripe_plan' => 'price_1NT5yeCwr8UATqaQjCbuBQkV',
                'price' => 100,
                'description' => 'Standard Package',
                'duration' => '1 Month',
                'status' => 'Active'
            ],
            [
                'name' => 'Premium Package',
                'stripe_plan' => 'sub_1NTAuQCwr8UATqaQRVEyUwIo',
                'price' => 200,
                'description' => 'Premium Package',
                'duration' => '3 Month',
                'status' => 'Active'
            ]


        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }

}
