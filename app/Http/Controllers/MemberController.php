<?php

namespace App\Http\Controllers;

use App\Events\AccountCreated;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $members = User::orderBy('updated_at', 'desc')
                ->paginate(20);
        $data['members'] = $members;

        return View::make('admin.member.list', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.member.create');
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
            'firstName' => 'required|max:50|min:2',
            'lastName' => 'required|max:50|min:2',
            'gender' => 'required',
            'dateOfBirth' => 'required|max:30',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/member/add-new')
                ->withErrors($validator)
                ->withInput();
        } else{

            $member = new User();
            $member->firstName = $inputs['firstName'];
            $member->lastName = $inputs['lastName'];
            $member->gender = $inputs['gender'];
            $member->dateOfBirth = date('Y-m-d', strtotime($inputs['dateOfBirth']));
            $member->email = $inputs['email'];
            $member->type = $inputs['type'];
            $member->profileTitle = $inputs['profileTitle'];
            $member->status = 1;
            $member->password = bcrypt($member->email);
            $member->save();

            event(new AccountCreated($member));
        }

        return redirect('/admin/member/list?status=success&member='.$member->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = User::find($id);
        $data['member'] = $member;

        return View::make('admin.member.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = User::findOrFail($id);
        $data['member'] = $member;
        return View::make('admin.member.edit', $data);
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
            'firstName' => 'required|max:50|min:2',
            'lastName' => 'required|max:50|min:2',
            'gender' => 'required',
            'dateOfBirth' => 'required|max:30',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/member/add-new')
                ->withErrors($validator)
                ->withInput();
        } else{
            $member = User::find($id);
            $member->firstName = $inputs['firstName'];
            $member->lastName = $inputs['lastName'];
            $member->gender = $inputs['gender'];
            $member->dateOfBirth = date('Y-m-d', strtotime($inputs['dateOfBirth']));
            $member->email = $inputs['email'];
            $member->profileTitle = $inputs['profileTitle'];
            $member->save();
        }

        return redirect('/admin/member/list?status=success&member='.$member->id);
    
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
