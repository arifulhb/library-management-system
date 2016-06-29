@extends('admin')
@section('title') Edit Author - {{ $common['appShort'] }} @stop

@section("content")
    <section class="content-header">
        <h1><i class="fa fa-pencil"></i> Edit Author</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-user"></i> Admin</a></li>
            <li class="">
                <a href="{{ url('/admin/author/list') }}">Author List</a>
            </li>
            <li class="">
                <a href="{{ url('/author/' .  $author->id . '/'.str_slug($author->name)) }}">{{ $author->name }}</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
    </section>

    <section id="createBook" class="content author-form">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Author Details</h3>
                    </div>
                    <form method="post" action="{{ url('/').'/admin/author/'.$author->id }}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="authorId" id="authorId" value="{{ $author->id }}">

                        <div class="box-body">
                            @if (count($errors) > 0)
                                <div class="">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-12">
                                    <div class="form-group">
                                        <label for="mName">Name</label>
                                        <input type="text" class="form-control input-lg" id="mName" placeholder="Name"
                                               name="name" value="{{ $author->name }}" maxlength="100" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="mGender">Gender</label>
                                        <select required class="form-control input-lg" name="gender" id="mGender">
                                            <option {{ $author->gender=='Male'? 'SELECTED':'' }} >Male</option>
                                            <option {{ $author->gender=='Female'? 'SELECTED':'' }} >Female</option>
                                            <option {{ $author->gender=='Other'? 'SELECTED':'' }} >Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="" for="mDOB">Date of Birth</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg date-picker" id="mDOB"
                                                   placeholder="Date of Birth" maxlength="30" name="dateOfBirth"
                                                   value="{{ isset($author->dateOfBirth) ? date('d M, Y', strtotime($author->dateOfBirth)) : '' }}">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <label for="aCountry">Country</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg" id="aCountry"
                                                   placeholder="Country"
                                                   data-provide="typeahead" autocomplete="off" disabled="disabled"
                                                   name="country" value="{{ $author->country }}" maxlength="100"
                                                   required>
                                            <span class="input-group-addon"><i id="faCountry"
                                                                               class="fa fa-spinner fa-pulse"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="aBio">Short Bio</label>
                                    <textarea class="form-control input-lg" name="bio" maxlength="256" id="aBio"
                                    >{{ $author->shortBio }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="" for="aEmail">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                            <input type="email" class="form-control input-lg" id="aEmail"
                                                   value="{{ $author->email }}" placeholder="Email" maxlength="50"
                                                   name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="" for="aTwitter">Twitter</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">twitter.com/</span>
                                            <input type="text" class="form-control input-lg" id="aTwitter"
                                                   value="{{ $author->twitter }}" placeholder="twitter" maxlength="50"
                                                   name="twitter">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="" for="aWebsite">Website</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">http//www.</span>
                                            <input type="text" class="form-control input-lg" id="aWebsite"
                                                   value="{{ $author->website }}" placeholder="website" maxlength="100"
                                                   name="website">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <p class="text-right">
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@stop