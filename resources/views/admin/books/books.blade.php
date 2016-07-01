@extends('admin')
@section('title') Book List - {{ $common['appShort'] }} @stop

@section("content")
    <section class="content-header">
        <h1><i class="fa fa-book"></i> Books <small>List of Books</small></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-user"></i> Admin</a></li>
            <li class="active">
                <a href="{{ url('/admin/book/list') }}">Book</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <input type="hidden" id="page_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Book List</h3>
                        <p class='pull-right'>
                            <a href="{{ url('/').'/admin/book/add-new' }}" class="btn btn-xs btn-info">
                                <i class="fa fa-plus"></i> Add New</a>
                        </p>
                    </div>
                    <div class="box-body">

                        @if(Session::has('deleteStatus'))
                            <div class="alert alert-warning">
                                <p><i class="fa fa-warning"></i> {{ Session::get('deleteStatus') }}</p>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>ISBN</th>
                                    <th>Authors</th>
                                    <th>Publisher</th>
                                    <th>Publish Date</th>
                                    <th>Category</th>
                                    <th>Shelf</th>
                                    <th>Added</th>
                                    <th>...</th>
                                </thead>
                                <tbody>
                                @foreach($books as $book)
                                    <tr>
                                        <td>
                                            <img src="http://placehold.it/50x70" class="thumbnail"
                                                 alt="{{ $book->title }}">
                                        </td>
                                        <td>
                                            <a href="{{ url('/book').'/'.$book->id.'/'.str_slug($book->title) }}" title="{{ $book->title }}"
                                            >{{ $book->title }}</a> <span class="text-muted">({{ $book->copies()->count() }})</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">ISBN 10:</span> {{ $book->isbn10 }}<br>
                                            <span class="text-muted">ISBN 13:</span> {{ $book->isbn13 }}
                                        </td>
                                        <td>
                                            @foreach($book->authors as $author)
                                                {{ $author->name }}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ $book->publisher->name }}</td>
                                        <td><small class="text-muted">{{ date('d M', strtotime($book->publishDate)) }}</small>
                                            {{ date('Y', strtotime($book->publishDate)) }}
                                        </td>
                                        <td>
                                            @foreach($book->categories as $category)
                                                {{ $category->title }}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ $book->shelfName }}</td>
                                        <td>{{ $book->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ url('/admin/').'/book/'.$book->id.'/edit' }}" class="btn btn-link" >
                                                    <i class="fa fa-pencil"></i></a>
                                                <a href="{{ url('/admin').'/book/'.$book->id.'/delete' }}" class="btn btn-link">
                                                    <i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="box-footer">
                        <p>{!! $books->render() !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop