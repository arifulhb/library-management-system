<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Publisher;
use Faker\Factory as Faker;

class PublisherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('publishers')->delete();

        $gender = Array('Male', 'Female', 'Other');
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            $publisher = new Publisher();
            $publisher->name = $faker->company;
            $publisher->establishYear =  $faker->dateTimeBetween($startDate = '-90 years', $endDate = '-1 years', $timezone = date_default_timezone_get())->format('Y');
            $publisher->country = $faker->country;
            $publisher->phone = $faker->phoneNumber;
            $publisher->email = $faker->safeEmail;
            $publisher->website = 'http://www.'.$faker->domainName;
            $publisher->save();
        }

    }
}