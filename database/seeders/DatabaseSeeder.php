<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
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
        // seed test countries, states and cities
        Country::factory()->count(20)->create()->each(function ($country) {
            State::factory()->count(10)->for($country)->create()->each(function ($state) {
                City::factory()->count(5)->for($state)->create();
            });
        });

        // seed admin user
        User::factory()->for(City::get()->random())->create([
            'name' => 'John Doe',
            'email' => 'admin@mailing.site',
            'is_admin' => true,
        ]);
    }
}
