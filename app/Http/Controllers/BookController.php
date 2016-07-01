<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Http\Requests;
    use Illuminate\Support\Facades\Validator;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\View;
    use App\Book;
    use Auth;
    use Carbon\Carbon;
    use App\BookCopy;
    use Illuminate\Support\Facades\Config;
    use DB;

    class BookController extends Controller
    {

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $book = Book::with('authors', 'categories', 'publisher')
                        ->orderBy('updated_at', 'desc')
                        ->paginate(15);
            $data['books'] = $book;

            return View::make('admin.books.books', $data);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $data['shelfs'] = Config::get('lms.shelfNames');
            $data['shelfLevels'] = Config::get('lms.shelfRackLevel');

            return View::make('admin.books.create', $data);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'title'     => 'required|max:256|min:3',
                'isbn10'    => 'required|max:10|min:10',
                'isbn13'    => 'required|max:13|min:13',
                'edition'   => 'required|max:100',
                'author1'   => 'required',
                'publisher' => 'required',
                'category1' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('admin/book/add-new')
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $book = new Book();
                $book->title = $inputs['title'];
                $book->edition = $inputs['edition'];
                $book->publisher_id = $inputs['publisher'];
                $book->publishDate = date('Y-m-d', strtotime($inputs['publishDate']));
                $book->isbn10 = $inputs['isbn10'];
                $book->isbn13 = $inputs['isbn13'];
                $book->shelfName = $inputs['shelf'];
                $book->shelfRackLevel = $inputs['shelfLevel'];
                $book->added_by = Auth::user()->id;
                $book->save();

                $book->authors()->attach($inputs['author1']);
                if (isset($inputs['author2'])) {
                    if (strlen($inputs['author2']) > 0) {
                        $book->authors()->attach($inputs['author2']);
                    }
                }
                if (isset($inputs['author3'])) {
                    if (strlen($inputs['author3']) > 0) {
                        $book->authors()->attach($inputs['author3']);
                    }
                }

                $book->categories()->attach($inputs['category1']);
                if (isset($inputs['category2'])) {
                    if (strlen($inputs['category2']) > 0) {
                        $book->categories()->attach($inputs['category2']);
                    }
                }
                if (isset($inputs['category3'])) {
                    if (strlen($inputs['category3']) > 0) {
                        $book->categories()->attach($inputs['category3']);
                    }
                }

                for ($i = 0; $i < intval($inputs['copy']); $i++) {
                    $copy = new BookCopy();
                    $copy->bookCode = $copy->generateBookCode($book->shelfName, $book->shelfRackLevel);
                    $copy->status = 1;
                    $copy->book_id = $book->id;
                    $copy->added_by = Auth::user()->id;
                    $book->copies()->save($copy);
                }

                return redirect('/admin/book/list');
            }

        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $book = Book::with('authors', 'publisher', 'categories', 'copies')->find($id);

            $data['book'] = $book;

            return View::make('browser.book.show', $data);

        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $book = Book::findOrFail($id);
            $data['book'] = $book;
            $data['shelfs'] = Config::get('lms.shelfNames');
            $data['shelfLevels'] = Config::get('lms.shelfRackLevel');

            return View::make('admin.books.edit', $data);
        }

        public function postUpdateCopy(Request $request, $id, $copyId)
        {
            $inputs = $request->all();
            $bookCopy = BookCopy::find($copyId);
            $bookCopy->status = $inputs['status'];
            $bookCopy->save();

            return redirect('/admin/book/' . $id . '/edit');
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'title'     => 'required|max:256|min:3',
                'isbn10'    => 'required|max:10|min:10',
                'isbn13'    => 'required|max:13|min:13',
                'edition'   => 'required|max:100',
                'author1'   => 'required',
                'publisher' => 'required',
                'category1' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('admin/book/add-new')
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $book = Book::find($id);
                $book->title = $inputs['title'];
                $book->edition = $inputs['edition'];
                $book->publisher_id = $inputs['publisher'];
                $book->publishDate = date('Y-m-d', strtotime($inputs['publishDate']));
                $book->isbn10 = $inputs['isbn10'];
                $book->isbn13 = $inputs['isbn13'];
                $book->shelfName = $inputs['shelf'];
                $book->shelfRackLevel = $inputs['shelfLevel'];
                $book->save();

                $authors = [$inputs['author1']];
                if (isset($inputs['author2'])) {
                    if (strlen($inputs['author2']) > 0) {
                        array_push($authors, $inputs['author2']);
                    }
                }
                if (isset($inputs['author3'])) {
                    if (strlen($inputs['author3']) > 0) {
                        array_push($authors, $inputs['author3']);
                    }
                }
                $book->authors()->sync($authors);


                $categories = [[$inputs['category1']]];
                if (isset($inputs['category2'])) {
                    if (strlen($inputs['category2']) > 0) {
                        array_push($categories, $inputs['category2']);
                    }
                }
                if (isset($inputs['category3'])) {
                    if (strlen($inputs['category3']) > 0) {
                        array_push($categories, $inputs['category2']);
                    }
                }
                $book->categories()->sync($categories);

                return redirect('/admin/book/list');
            }
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy(Request $request, $id)
        {
            $book = Book::find($id);
            $book->delete();
            $request->session()->flash('deleteStatus', 'Book ' . $book->title . ' deleted.');

            return redirect('/admin/book/list');
        }

        /**
         * @param $id
         * @param $authorId
         *
         * @since  vx.x.x
         * @author Ariful Haque <arifulhb@gmail.com>
         * @return \Illuminate\Http\JsonResponse
         */
        public function deleteAuthor($id, $authorId)
        {
            $book = Book::find($id);
            $result = $book->authors()->detach($authorId);

            return response()
                ->json(['result' => $result], 204);
        }

        public function getDelete(Request $request, $id)
        {

            $inputs = $request->all();

            if (isset($inputs['trashed'])) {
                $book = Book::with(array(
                    'copies' => function ($query) {
                        $query->withTrashed();
                    },
                ))
                            ->find($id);
            } else {
                $book = Book::with('authors', 'copies')->find($id);
            }

            $data['book'] = $book;

            return View::make('admin.books.delete', $data);

        }

        public function deleteCopy($id, $copyId)
        {

            $copy = BookCopy::find($copyId);
            $copy->delete();

            return redirect('/admin/book/' . $id . '/delete');
        }

        public function search(Request $request)
        {
            /*      $books = Book::select('id', 'title', 'edition'  )
                                         ->where('title', 'LIKE', '%'.$request->input('q').'%')
                                         ->get();*/

            $books = DB::table('books')
                       ->join('books_copies', 'books_copies.book_id', '=', 'books.id')
                       ->join('author_book', 'author_book.book_id', '=', 'books.id')
                       ->join('authors', 'authors.id', '=', 'author_book.author_id')
                       ->select('books.id', 'books_copies.id as copyId', 'books.title', 'books.edition',
                           'books_copies.id as copyId', 'books_copies.bookCode', 'books_copies.status as copyStatus',
                           'authors.id as authorId', 'authors.name as authorName')
                       ->where('books.title', 'LIKE', '%' . $request->input('q') . '%')
                       ->orWhere('authors.name', 'LIKE', '%' . $request->input('q') . '%')
                       ->groupBy('copyId')
                       ->get();

            $result = ['result' => $books];

            return response()->json($result);
        }


        /**
         * @param Request $request
         * @param $id
         *
         * @since  vx.x.x
         * @author Ariful Haque <arifulhb@gmail.com>
         * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function postAddCopy(Request $request, $id)
        {

            $book = Book::find($id);

            $copy = new BookCopy();
            $copy->bookCode = $copy->generateBookCode($book->shelfName, $book->shelfRackLevel);
            $copy->status = 1;
            $copy->book_id = $book->id;
            $copy->added_by = Auth::user()->id;
            $book->copies()->save($copy);

            return redirect('/admin/book/' . $book->id . '/edit');
        }

        /**
         * @param $id
         * @param $categoryId
         *
         * @return \Illuminate\Http\JsonResponse
         *
         * @since  vx.x.x
         * @author Ariful Haque <arifulhb@gmail.com>
         */
        public function deleteCategory($id, $categoryId)
        {
            $book = Book::find($id);
            $result = $book->categories()->detach($categoryId);

            return response()
                ->json(['result' => $result], 204);
        }

    }
