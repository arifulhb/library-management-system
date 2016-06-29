<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->delete();
        /**
         * Real data
         */

        $admin = new User();
        $admin->firstName = 'Ariful';
        $admin->lastName = 'Haque';
        $admin->profileTitle = 'Programmer';
        $admin->gender = 'Male';
        $admin->dateOfBirth =  '1983-01-14';
        $admin->type = 'Admin';
        $admin->status = 1;
        $admin->email = 'system@lms.net';
        $admin->password = bcrypt('system@lms.net');
        $admin->save();

        /**
         * Fake Data
         */
        $gender = Array('Male', 'Female', 'Other');
        $type= Array('Member', 'Admin');

        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            $user = new User();
            $user->firstName = $faker->firstName;
            $user->lastName = $faker->lastName;
            $user->profileTitle = $faker->sentence;
            $user->gender = $gender[rand(0,2)];
            $user->dateOfBirth =  $faker->dateTimeThisCentury->format('Y-m-d');
            $user->type = $type[rand(0,1)];
            $user->status = 1;
            $user->email = $faker->email;
            $user->password = bcrypt('secret');
            $user->save();
        }

    }
}