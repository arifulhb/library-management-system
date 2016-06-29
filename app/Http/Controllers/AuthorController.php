<?php

    namespace App\Http\Controllers;

    use App\Http\Requests;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\View;
    use App\Http\Controllers\Controller;
    use App\Author;

    class AuthorController extends Controller
    {

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {

            $authors = Author::orderBy('updated_at', 'desc')
                             ->paginate(20);
            $data['authors'] = $authors;

            return View::make('admin.author.list', $data);

        }


        /**
         * @param Request $request
         *
         * @return \Illuminate\Http\JsonResponse
         *
         * @since  vx.x.x
         * @author Ariful Haque <arifulhb@gmail.com>
         */
        public function getSearch(Request $request)
        {

            $authors = Author::select('id', 'name', 'country')
                             ->where('name', 'LIKE', '%' . $request->input('q') . '%')
                             ->get();

            $result = ['result' => $authors];

            return response()->json($result);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return View::make('admin.author.create');
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
                'name'   => 'required|max:100|min:3',
                'gender' => 'required',
                'bio'    => 'required|min:20',
            ]);

            if ($validator->fails()) {
                return redirect('admin/author/add-new')
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $author = new Author();
                $author->name = $inputs['name'];
                $author->gender = $inputs['gender'];
                $author->shortBio = $inputs['bio'];
                if (isset($inputs['country'])) {
                    $author->country = $inputs['country'];
                }
                if (isset($inputs['dateOfBirth'])) {
                    $author->dateOfBirth = date('Y-m-d', strtotime($inputs['dateOfBirth']));
                }
                if (isset($inputs['email'])) {
                    $author->email = $inputs['email'];
                }
                if (isset($inputs['twitter'])) {
                    $author->twitter = $inputs['twitter'];
                }
                if (isset($inputs['website'])) {
                    $author->website = $inputs['website'];
                }
                $author->save();
            }

            return redirect('/admin/author/list?status=success&author=' . $author->id);
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
            $author = Author::with('books')->find($id);

            $data['author'] = $author;

            return View::make('browser.author.show', $data);

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
            $author = Author::findOrFail($id);
            $data['author'] = $author;
            return View::make('admin.author.edit', $data);
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
                'name'   => 'required|max:100|min:3',
                'gender' => 'required',
                'bio'    => 'required|min:20',
            ]);

            if ($validator->fails()) {
                return redirect('admin/author/add-new')
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $author = Author::find($id);
                $author->name = $inputs['name'];
                $author->gender = $inputs['gender'];
                $author->shortBio = $inputs['bio'];
                if (isset($inputs['country'])) {
                    $author->country = $inputs['country'];
                }
                if (strlen($inputs['dateOfBirth']) >0) {
                    $author->dateOfBirth = date('Y-m-d', strtotime($inputs['dateOfBirth']));
                } else{
                    $author->dateOfBirth = NULL;
                }
                if (isset($inputs['email'])) {
                    $author->email = $inputs['email'];
                } else{
                    $author->email = null;
                }
                if (isset($inputs['twitter'])) {
                    $author->twitter = $inputs['twitter'];
                } else{
                    $author->twitter = null;
                }
                if (isset($inputs['website'])) {
                    $author->website = $inputs['website'];
                } else{
                    $author->website = null;
                }
                $author->save();
            }

            return redirect('/admin/author/list?status=success&author=' . $author->id);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    }
