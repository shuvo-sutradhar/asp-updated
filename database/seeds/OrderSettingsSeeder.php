<?php

use App\OrderSetting;
use Illuminate\Database\Seeder;

class OrderSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	
        OrderSetting::insert([
            [
                'key' => 'order.initialOrderStatus',
                'display_name' => 'Initial Order Status',
                'value' => 'submitted',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'order.revision',
                'display_name' => 'Allow Order Request Revision',
                'value' => 'true',
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'order.revisionOrderStatus',
                'display_name' => 'Change status of completed orders when client sends a message or requests a revision',
                'value' => 'working',
                'created_at' => \now(),
                'updated_at' => \now(),
            ]
        ]);
    }
}
