@extends('admin')
@section('title') Edit Publisher - {{ $common['appShort'] }} @stop

@section("content")
    <section class="content-header">
        <h1><i class="fa fa-pencil"></i> Edit Publisher</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-user"></i> Admin</a></li>
            <li class="">
                <a href="{{ url('/admin/publisher/list') }}">Publisher List</a>
            </li>
            <li class="">
                <a href="{{ url('/publisher/' .  $publisher->id . '/'.str_slug($publisher->name)) }}">{{ $publisher->name }}</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
    </section>

    <section id="createBook" class="content publisher-form">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Publisher Details</h3>
                    </div>
                    <form method="post" action="{{ url('/').'/admin/publisher/'.$publisher->id }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="publisherId" id="publisherId" value="{{ $publisher->id }}">

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
                                               name="name" value="{{ $publisher->name }}" maxlength="100" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="" for="pEstablishYear">Establish year</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control input-lg" id="pEstablishYear"
                                                   placeholder="e.g. 1984" maxlength="4" name="establishYear"
                                                   value="{{ $publisher->establishYear }}">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <label for="aCountry">Country</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg" id="aCountry" placeholder="Loading Country"
                                               data-provide="typeahead" autocomplete="off" disabled="disabled"
                                               name="country" value="{{ $publisher->country }}" maxlength="100" required>
                                            <span class="input-group-addon"><i id="faCountry" class="fa fa-spinner fa-pulse"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="" for="pPhone">Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" class="form-control input-lg" id="pPhone"
                                                   value="{{ $publisher->phone }}" placeholder="Phone" maxlength="20" name="phone" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="" for="aEmail">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                            <input type="email" class="form-control input-lg" id="aEmail"
                                                   value="{{ $publisher->email }}" placeholder="Email" maxlength="50" name="email" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="" for="aWebsite">Website</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">http//www.</span>
                                            <input type="text" class="form-control input-lg" id="aWebsite"
                                                   value="{{ $publisher->website }}" placeholder="website" maxlength="100" name="website" >
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