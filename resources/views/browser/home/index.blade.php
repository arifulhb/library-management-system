@extends('browse')
@section('title') Book List - {{ $common['appShort'] }} @stop

@section("content")

    <section class="content">
        <input type="hidden" id="page_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header with-border"><h3 class="box-title">Book List</h3></div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Authors</th>
                                <th>Publisher</th>
                                <th>Publish Date</th>
                                <th>Category</th>
                                <th>Shelf</th>
                                <th>Added</th>

                                </thead>
                                <tbody>
                                @foreach($books as $book)
                                    <tr>
                                        <td>
                                            <img src="http://placehold.it/50x70" class="thumbnail"
                                                 alt="{{ $book->title }}">
                                        </td>
                                        <td>
                                            <p><a href="{{ url('/book').'/'.$book->id.'/'.str_slug($book->title) }}"
                                                  title="{{ $book->title }}" data-toggle="tooltip">
                                                {{ $book->title }}</a> <small> - {{ $book->edition }}
                                                <span class="text-muted"> ({{ $book->copies()->count() }})</span></small>
                                            </p>
                                            <p>
                                                <small><span class="text-muted">ISBN 10:</span> {{ $book->isbn10 }}</small><br>
                                                <small><span class="text-muted">ISBN 13:</span> {{ $book->isbn13 }}</small>
                                            </p>
                                        </td>
                                        <td>
                                            @foreach($book->authors as $author)
                                                <a href="{{ url('/').'/author/'.$author->id.'/'.str_slug($author->name) }}">
                                                    <i class="fa fa-user text-muted"></i> {{ $author->name }}<br></a>
                                            @endforeach
                                        </td>
                                        <td>{{ $book->publisher->name }}</td>
                                        <td><small class="text-muted">{{ date('d M', strtotime($book->publishDate)) }}</small>
                                            {{ date('Y', strtotime($book->publishDate)) }}
                                        </td>
                                        <td>
                                            @foreach($book->categories as $category)
                                                <label class="label label-info">{{ $category->title }}</label>
                                            @endforeach
                                        </td>
                                        <td>{{ $book->shelfName }}</td>
                                        <td>{{ $book->created_at->diffForHumans() }}</td>
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