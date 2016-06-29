@extends('browse')
@section('title') {{ $author->name }} - Author | {{ $common['appShort'] }} @stop

@section("content")
    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <header style="border-bottom: 1px solid #cccccc;padding-bottom: 10px;">
                    <h2>{{ $author->name }}</h2>
                    <div class="row">
                        <div class="col-lg-6 pull-left"><span>{{ $author->country }}</span></div>
                        <div class="col-lg-6 pull-right text-right">{{ $author->dateOfBirth->format('d M, Y') }}</div>
                    </div>
                </header>
                <section>
                    <h3>{{ $author->books->count()  }} Books</h3>
                    @foreach($author->books->chunk(3) as $chunk)
                        <div class="row">
                            @foreach($chunk as $chunkKey => $book)

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class=" well well-sm">
                                        <h4 class="text-info">
                                            <a href="{{ url('/').'/book/'.$book->id.'/'.str_slug($book->title) }}"
                                            >{{ $book->title }}</a>
                                        </h4>
                                        <p><i class="fa fa-building"></i> {{ $book->publisher->name }}</p>
                                        @foreach($book->categories as $cat)
                                            <label class="label label-info">{{ $cat->title }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </section>

            </div>
            <div class="col-lg-3 col-md-2 hidden-sm hidden-xs">
            </div>
        </div>
    </section>
@stop