<?php

use App\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	
        GeneralSetting::insert([
            [
                'key' => 'app.name',
                'display_name' => 'Company Name',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'app.light_logo',
                'display_name' => 'Light Logo',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'app.dark_logo',
                'display_name' => 'Dark Logo',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'app.favicon',
                'display_name' => 'Favicon',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'app.sidebar_color',
                'display_name' => 'Sidebar Color',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'app.topbar_color',
                'display_name' => 'Topbar Color',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'app.body_color',
                'display_name' => 'Body Color',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'app.bradecamb_color',
                'display_name' => 'Bradecamb color',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'app.timezone',
                'display_name' => 'timezone',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ],
            [
                'key' => 'app.contact_link',
                'display_name' => 'contact link',
                'value' => null,
                'created_at' => \now(),
                'updated_at' => \now(),
            ]
        ]);
    }
}
