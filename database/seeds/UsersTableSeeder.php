<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $password = Hash::make('secret');

        //make Admin user
        User::create([
            'last_name' => 'Admin',
            'first_name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => $password,
            'group_id' => null,
        ]);



        // generate 10 users
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'last_name' => $faker->lastName,
                'first_name' => $faker->firstName,
                'email' => $faker->email,
                'is_active' => $faker->randomElement([0, 1]),
                'group_id' => $faker->numberBetween($min = 1, $max = 10),
                'password' => $password,
            ]);
        }
    }
}
