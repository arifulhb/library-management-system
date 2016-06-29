<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(BookCategoryTableSeeder::class);
        $this->call(AuthorTableSeeder::class);
        $this->call(PublisherTableSeeder::class);
        $this->call(BookTableSeeder::class);

        Model::reguard();
    }
}
