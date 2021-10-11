<?php

use Illuminate\Database\Seeder;
//use Database\Seeders\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        //factory(App\User::class, 5000)->create();
        //factory(App\Role::class, 5000)->create();
        $this->call([
            OrderSettingsSeeder::class,
            PermissionSeeder::class,
            GeneralSettingsSeeder::class,
        ]);
    }
}
