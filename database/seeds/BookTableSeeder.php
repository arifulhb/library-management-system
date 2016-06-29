<?php

    use Illuminate\Support\Facades\DB;
    use Illuminate\Database\Seeder;
    use App\User;
    use App\Book;
    use App\Author;
    use App\Publisher;
    use App\BookCategory;
    use App\BookCopy;
    use Faker\Factory as Faker;

    class BookTableSeeder extends Seeder
    {

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {

            DB::table('author_book')->delete();
            DB::table('book_category')->delete();
            DB::table('books')->delete();

            $editions = ['1st Edition', '2nd Edition', '3rd Edition', 'Special Edition', '4th Edition'];
            $shelfNames = ['Shelf 1', 'Shelf 2', 'Shelf 3', 'Shelf 4', 'Shelf 5', 'Shelf 6', 'Shelf 7', 'Shelf 8'];
            $shelfRackLevel = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];

            $faker = Faker::create();
            $publishers = Publisher::all()->lists('id')->toArray();
            $authors = Author::all()->lists('id')->toArray();
            $bookCategory = BookCategory::all()->lists('id')->toArray();
            $librarian = User::where('type', '=', 'admin')->lists('id')->toArray();

            foreach (range(1, 700) as $index) {
                $book = new Book();
                $book->title = $faker->sentence(5);
                $book->isbn10 = $faker->isbn10;
                $book->isbn13 = $faker->isbn13;
                $book->publishDate = $faker->dateTimeBetween($startDate = '-90 years', $endDate = '-1 months',
                    $timezone = date_default_timezone_get())->format('Y-m-d');
                $book->publishYear = date('Y', strtotime($book->publishDate));
                $book->edition = $editions[rand(0, 4)];
                $book->publisher_id = $faker->randomElement($publishers);
                $book->shelfName = $shelfNames[rand(0, 7)];
                $book->shelfRackLevel = $shelfRackLevel[rand(0, 9)];
                $book->thumbnail = '';
                $book->added_by = $faker->randomElement($librarian);
                $book->save();

                /*
                 * Attach Authors
                 */
                $authorNumber = rand(1, 3);
                for ($i = 1; $i <= $authorNumber; $i++) {
                    $book->authors()->attach($faker->randomElement($authors));
                }

                /**
                 * Attach book category
                 */
                $category = rand(1, 3);
                $categoryType = ['first', 'second', 'third'];
                for ($i = 1; $i <= $category; $i++) {
                    $book->categories()->attach($faker->randomElement($bookCategory),  ['type' => $categoryType[$i-1]]);
                }

                /**
                 * Book Copy
                 */
                $bookCopy = rand(1, 3);

                for ($i = 1; $i <= $bookCopy; $i++) {
                    $copy = new BookCopy();
//                    $copy->bookCode = $book->generateBookCode($book->shelfName, $book->shelfRackLevel);
                    $copy->bookCode = $copy->generateBookCode($book->shelfName, $book->shelfRackLevel);
                    $copy->status = 1;
                    $copy->book_id = $book->id;
                    $copy->added_by = $faker->randomElement($librarian);
                    $book->copies()->save($copy);
                }

            }
        }
    }