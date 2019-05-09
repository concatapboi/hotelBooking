<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Models\User::class, 4)->create();
        DB::table('hotel_manager')->insert([
            'user_id' => 1,
        ]);

        DB::table('hotel_manager')->insert([
            'user_id' => 2,
        ]);

        DB::table('customer')->insert([
            'user_id' => 3,
            'coin' => 0,
            'address' => 'Moon Palace',
        ]);

        DB::table('customer')->insert([
            'user_id' => 4,
            'coin' => 0,
            'address' => 'Mars Palace',
        ]);

        factory(App\Models\Admin::class, 1)->create();
    }
}
