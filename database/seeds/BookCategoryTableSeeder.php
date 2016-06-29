<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\BookCategory;
use Faker\Factory as Faker;

class BookCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $category = [
           ['title'=>'Arts', 'categoryCode'=>'art', 'description'=>'Arts Books', 'isActive'=> true],
           ['title'=>'Science', 'categoryCode'=>'snc', 'description'=>'Science', 'isActive'=> true],
           ['title'=>'Science Fiction', 'categoryCode'=>'scf', 'description'=>'Science Fiction', 'isActive'=> true],
           ['title'=>'Business', 'categoryCode'=>'bsn', 'description'=>'Business', 'isActive'=> true],
           ['title'=>'War', 'categoryCode'=>'war', 'description'=>'War books', 'isActive'=> true],
           ['title'=>'History', 'categoryCode'=>'hst', 'description'=>'History books', 'isActive'=> true],
           ['title'=>'Poetry', 'categoryCode'=>'ptr', 'description'=>'Poetry books', 'isActive'=> true],
           ['title'=>'Religion', 'categoryCode'=>'rlt', 'description'=>'Religious books', 'isActive'=> true],
           ['title'=>'Romance', 'categoryCode'=>'rmn', 'description'=>'Romance', 'isActive'=> true],
           ['title'=>'Fiction', 'categoryCode'=>'fcn', 'description'=>'Fiction', 'isActive'=> true],
           ['title'=>'Biography', 'categoryCode'=>'bio', 'description'=>'Biography', 'isActive'=> true],
           ['title'=>'Management', 'categoryCode'=>'mgt', 'description'=>'Management', 'isActive'=> true],
           ['title'=>'Sports', 'categoryCode'=>'spt', 'description'=>'Sports', 'isActive'=> true],
           ['title'=>'Programming', 'categoryCode'=>'prg', 'description'=>'Programming', 'isActive'=> true],
           ['title'=>'Travel', 'categoryCode'=>'trv', 'description'=>'Travel', 'isActive'=> true],
           ['title'=>'Literature', 'categoryCode'=>'ltr', 'description'=>'Literature', 'isActive'=> true],
           ['title'=>'Academic', 'categoryCode'=>'acd', 'description'=>'Academic', 'isActive'=> true],
           ['title'=>'Food', 'categoryCode'=>'fod', 'description'=>'Food and Cuisine', 'isActive'=> true],
           ['title'=>'Fantasy', 'categoryCode'=>'fnt', 'description'=>'Fantasy', 'isActive'=> true],
           ['title'=>'Crime', 'categoryCode'=>'crm', 'description'=>'Crime', 'isActive'=> true],
       ];

        BookCategory::insert($category);
    }
}