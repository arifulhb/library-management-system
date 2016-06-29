@extends('browse')
@section('title') {{ $book->title }} - Book | {{ $common['appShort'] }} @stop

@section("content")
    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <header style="border-bottom: 1px solid #cccccc;padding-bottom: 10px;">
                    <h2>{{ $book->title }}</h2>
                    <div class="row">
                        <div class="col-lg-6 pull-left"><span>{{$book->edition}}</span></div>
                        <div class="col-lg-6 pull-right text-right">
                            <i class="fa fa-tags"></i>
                            @foreach($book->categories as $category)
                                <a href="#"><span class="label label-info">{{ $category->title }}</span></a>
                            @endforeach
                        </div>
                    </div>
                </header>
                <section>
                    <table class="table">
                        <tbody>

                        <tr>
                            <td><i class="fa fa-user"></i> Authors</td>
                            <td>
                                @foreach($book->authors as $author)
                                    <a href="{{ url('/').'/author/'.$author->id.'/'.str_slug($author->name) }}"
                                    >{{ $author->name }}</a><br/>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-copy"></i> Copy code</td>
                            <td>
                                @foreach($book->copies as $copy)
                                    <p>{{ $copy->bookCode }}
                                        <small class="text-muted">[ {{ $copy->status }} ]</small>
                                    </p>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-building-o"></i> Publisher</td>
                            <td>
                                {{ $book->publisher->name }}
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-info"></i> Other Info</td>
                            <td>
                                <small class="text-muted">Published:</small>{{ $book->publishDate->format('d M, Y') }}
                                <br/><br/>
                                <small class="text-muted">ISBN 10:</small>{{ $book->isbn10 }}<br/>
                                <small class="text-muted">ISBN 13:</small>{{ $book->isbn13 }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="col-lg-3 col-md-2 text-right">
            </div>
        </div>
    </section>
@stop