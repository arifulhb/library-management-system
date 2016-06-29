<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Author;
use Faker\Factory as Faker;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('authors')->delete();

        $gender = Array('Male', 'Female', 'Other');
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            $author = new Author();
            $author->name = $faker->name;
            $author->gender = $gender[rand(0,2)];
            $author->dateOfBirth =  $faker->dateTimeBetween($startDate = '-90 years', $endDate = '-25 years', $timezone = date_default_timezone_get())->format('Y-m-d');
            $author->shortBio = $faker->sentence(6, true);
            $author->country = $faker->country;
            $author->email = $faker->safeEmail;
            $author->twitter = $faker->userName;
            $author->website = 'http://www.'.$faker->domainName;
            $author->save();
        }

    }
}