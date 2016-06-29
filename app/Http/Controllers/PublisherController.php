<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Publisher;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $publishers = Publisher::orderBy('updated_at', 'desc')
                       ->paginate(20);
        $data['publishers'] = $publishers;
    
        return View::make('admin.publisher.list', $data);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @since  vx.x.x
     * @author Ariful Haque <arifulhb@gmail.com>
     */
    public function getSearch(Request $request){

        $publishers = Publisher::select('id', 'name', 'country', 'establishYear')
                                ->where('name', 'LIKE', '%'.$request->input('q').'%')
                                ->get();

        $result = ['result' => $publishers];

        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make($inputs, [
            'name'   => 'required|max:100|min:3',
            'country' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/publisher/add-new')
                ->withErrors($validator)
                ->withInput();
        } else {

            $publisher = new Publisher();
            $publisher->name = $inputs['name'];
            if (isset($inputs['country'])) {
                $publisher->country = $inputs['country'];
            }
            if (isset($inputs['establishYear'])) {
                $publisher->establishYear = $inputs['establishYear'];
            } else{
                $publisher->establishYear = null;
            }

            if (isset($inputs['email'])) {
                $publisher->email = $inputs['email'];
            } else{
                $publisher->email = null;
            }
            if (isset($inputs['phone'])) {
                $publisher->phone = $inputs['phone'];
            } else{
                $publisher->phone = null;
            }
            if (isset($inputs['website'])) {
                $publisher->website = $inputs['website'];
            } else{
                $publisher->website = null;
            }
            $publisher->save();
        }

        return redirect('/admin/publisher/list?status=success&publisher=' . $publisher->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publisher = Publisher::findOrFail($id);
        $data['publisher'] = $publisher;
        return View::make('admin.publisher.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();

        $validator = Validator::make($inputs, [
            'name'   => 'required|max:100|min:3',
            'country' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/publisher/add-new')
                ->withErrors($validator)
                ->withInput();
        } else {

            $publisher = Publisher::find($id);
            $publisher->name = $inputs['name'];
            if (isset($inputs['country'])) {
                $publisher->country = $inputs['country'];
            }
            if (isset($inputs['establishYear'])) {
                $publisher->establishYear = $inputs['establishYear'];
            } else{
                $publisher->establishYear = null;
            }
    
            if (isset($inputs['email'])) {
                $publisher->email = $inputs['email'];
            } else{
                $publisher->email = null;
            }
            if (isset($inputs['phone'])) {
                $publisher->phone = $inputs['phone'];
            } else{
                $publisher->phone = null;
            }
            if (isset($inputs['website'])) {
                $publisher->website = $inputs['website'];
            } else{
                $publisher->website = null;
            }
            $publisher->save();
        }

        return redirect('/admin/publisher/list?status=success&publisher=' . $publisher->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
