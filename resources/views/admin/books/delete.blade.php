@extends('admin')
@section('title') Delete {{ $book->title }} Book | {{ $common['appShort'] }} @stop

@section("content")
    <section class="content-header">
        <h1><i class="fa fa-trash"></i> Delete Book</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-user"></i> Admin</a></li>
            <li class="">
                <a href="{{ url('/admin/book/list') }}">Books</a>
            </li>
            <li class="">
                <a href="{{ url('/book/').'/'.$book->id.'/'.str_slug($book->title) }}">{{ $book->title }}</a>
            </li>
            <li class="active">
                Delete
            </li>
        </ol>
    </section>

    <section id="editBook" class="content book-form">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 col-md-12 col-sm-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-lg-10 col-sm-10">
                                <h3 class="box-title"><i class="fa fa-book"></i> <span
                                            class="text-danger">{{ $book->title }}</span>
                                </h3>
                            </div>
                            <div class="col-lg-2 col-sm-2 text-right">
                                @if(Input::has('trashed'))
                                    <a href="{{ url('/').'/admin/book/'.$book->id.'/delete' }}"><i
                                                class="fa fa-eye-slash"></i> Hide Trashed</a>
                                @else
                                    <a href="{{ url('/').'/admin/book/'.$book->id.'/delete?trashed=true' }}">
                                        <i class="fa fa-eye"></i> Show Trashed
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Book Code</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($book->copies as $copy)
                                <tr class="{{ $copy->deleted_at != null?'warning':'' }}">
                                    <form action="{{ url('/').'/admin/book/'.$book->id.'/copy/'.$copy->id }}"
                                          method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <td>{{ $copy->bookCode }}</td>
                                        <td>{{ $copy->status }}</td>
                                        <td class="text-right">
                                            @if($copy->deleted_at == null)
                                                <button class="btn-remove-book-copy btn btn-warning btn-sm"
                                                        type="submit">
                                                    Delete
                                                </button>
                                            @else
                                                <span class="text-muted"><i class="fa fa-trash-o"></i> trashed</span>
                                            @endif
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="box-footer">
                        <p class="">
                            <form action="{{ url('/').'/admin/book/'.$book->id }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <input name="_method" type="hidden" value="DELETE">
                                <span class="pull-left text-danger text-right">
                                    <strong>Delete all copy including the book book</strong>
                                </span>
                                <button class="pull-right btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>

                        </p>
                    </div>

                </div>
            </div>

        </div>
    </section>
@stop