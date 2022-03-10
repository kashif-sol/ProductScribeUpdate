<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('plans')->insert(array(
            array(
            'type' => "RECURRING",
            'name' => 'STARTER',
            'price' => 4.99,
            'interval' => "EVERY_30_DAYS",
            'capped_amount' => 10.00,
            'terms' => "5000",
            'trial_days' => 0,
            'test' => 1,
            'on_install' => 1,

            ),
            array(
                'type' => "RECURRING",
                'name' => 'BASIC',
                'price' => 19.99,
                'interval' => "EVERY_30_DAYS",
                'capped_amount' => 10.00,
                'terms' => 25000,
                'trial_days' => 0,
                'test' => 1,
                'on_install' => 1,
    
                ),
                array(
                    'type' => "RECURRING",
                    'name' => 'PRO',
                    'price' => 39.99,
                    'interval' => "EVERY_30_DAYS",
                    'capped_amount' => 10.00,
                    'terms' => 60000,
                    'trial_days' => 0,
                    'test' => 1,
                    'on_install' => 1,
        
                    ),
           
            ));

    }
}
