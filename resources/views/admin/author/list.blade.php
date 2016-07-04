@extends('admin')
@section('title') Author List - {{ $common['appShort'] }} @stop

@section("content")
    <section class="content-header">
        <h1><i class="fa fa-book"></i> Authors <small>List of Authors</small></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-user"></i> Admin</a></li>
            <li class="active">
                <a href="{{ url('author') }}">Authors</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <input type="hidden" id="page_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Author List</h3>
                        <p class='pull-right'>
                            {{--<button class="btn btn-xs btn-info" data-toggle="modal"
                                                      data-target="#addCompany">
                                <i class="fa fa-plus"></i> Add New</button>--}}
                        </p>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Year of Birth</th>
                                    <th>Country</th>
                                    <th>...</th>
                                </thead>
                                <tbody>
                                @foreach($authors as $author)
                                    <tr>
                                        <td>{{  $author->name }}</td>
                                        <td>
                                            {{ $author->gender }}
                                        </td>
                                        <td>
                                            @if(isset($author->dateOfBirth))
                                                <small class="text-muted">{{ $author->dateOfBirth->format('M') }}</small>
                                                {{ $author->dateOfBirth->format('Y') }}
                                            @endif
                                        </td>

                                        <td> {{ $author->country }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ url('/admin').'/author/'.$author->id.'/edit' }}" class="btn btn-link" >
                                                    <i class="fa fa-pencil"></i></a>
                                                <button class="btn btn-link"  data-toggle="modal" data-target="#deleteMember">
                                                    <i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="box-footer text-center">
                        <p class="text-center">{!! $authors->render() !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop