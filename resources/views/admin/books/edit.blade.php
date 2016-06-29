@extends('admin')
@section('title') Edit {{ $book->title }} - {{ $common['appShort'] }} @stop

@section("content")
    <section class="content-header">
        <h1><i class="fa fa-pencil"></i> Edit Book</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-user"></i> Admin</a></li>
            <li class="">
                <a href="{{ url('/admin/book/list') }}">Books</a>
            </li>
            <li class="">
                <a href="{{ url('/book/').'/'.$book->id }}">{{ $book->title }}</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
    </section>

    <section id="editBook" class="content book-form">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Book Details</h3>
                    </div>
                    <form method="post" action="{{ url('/').'/admin/book/'. $book->id }}" enctype="multipart/form-data">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="book-id" value="{{ $book->id }}">

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
                                <div class="col-lg-8 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="bookTitle">Book Title</label>
                                        <input type="text" class="form-control input-lg" id="bookTitle" placeholder="Book Title"
                                               name="title" value="{{ $book->title }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="bookEdition">Edition</label>
                                        <input type="text" class="form-control input-lg" id="bookEdition" placeholder="Edition"
                                               name="edition" value="{{ $book->edition }}" maxlength="100" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
{{--                                        {{ isset($book->authors()->get()[0]->name) ? $book->authors()->get()[0]->name : '' }}--}}
                                        <label id="authorLabel1" for="bookAuthor1">Author 1</label>
                                        <div class="input-group">
                                        <input type="text" class="form-control input-lg" id="bookAuthor1" placeholder="Author"
                                               maxlength="100" data-provide="typeahead" autocomplete="off" name="author1name"
                                               value="{{ array_key_exists(0, $book->authors()->get()->toArray()) ? $book->authors()->get()->toArray()[0]['name'] :'' }}">
                                        <div class = "input-group-btn">
                                            <button class = "btn btn-lg btn-default btn-flat clear-author" value="1" type="button"
                                                    data-toggle="tooltip" title="Clear">
                                                <i class="text-muted fa fa-eraser"></i></button>
                                        </div>
                                        <input type="hidden" id="author1" name="author1"
                                               value="{{ array_key_exists(0, $book->authors()->get()->toArray()) ? $book->authors()->get()->toArray()[0]['id'] :'' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label id="authorLabel2" for="bookAuthor2">Author 2</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg" id="bookAuthor2" placeholder="Author"
                                                   maxlength="100" data-provide="typeahead" autocomplete="off" name="author2name"
                                                   value="{{ array_key_exists(1, $book->authors()->get()->toArray()) ? $book->authors()->get()->toArray()[1]['name'] :'' }}">
                                            <input type="hidden" id="author2" name="author2"
                                                   value="{{ array_key_exists(1, $book->authors()->get()->toArray()) ? $book->authors()->get()->toArray()[1]['id'] :'' }}">
                                            <div class = "input-group-btn">
                                                <button class = "btn btn-lg btn-default btn-flat clear-author" value="2" type="button"
                                                        data-toggle="tooltip" title="Clear">
                                                    <i class="text-muted fa fa-eraser"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label id="authorLabel3" for="bookAuthor3">Author 3</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg" id="bookAuthor3" placeholder="Author"
                                               maxlength="100" data-provide="typeahead" autocomplete="off" name="author3name"
                                               value="{{ array_key_exists(2, $book->authors()->get()->toArray()) ? $book->authors()->get()->toArray()[2]['name'] :'' }}">
                                            <div class = "input-group-btn">
                                              <button class = "btn btn-lg btn-default btn-flat clear-author" value="3" type="button"
                                              data-toggle="tooltip" title="Clear">
                                                  <i class="text-muted fa fa-eraser"></i></button>
                                            </div>

                                            <input type="hidden" id="author3" name="author3"
                                               value="{{ array_key_exists(2, $book->authors()->get()->toArray()) ? $book->authors()->get()->toArray()[2]['id'] :'' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="" for="bookPublishDate">Publish Date</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg date-picker" id="bookPublishDate"
                                                   placeholder="Publish Date" maxlength="100" name="publishDate"
                                                   value="{{ date('d M, Y', strtotime($book->publishDate)) }}" required>
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label id="publiserLabel" for="bookPublisher">Publisher</label>
                                        <input type="text" class="form-control input-lg" id="bookPublisher" placeholder="Publisher" maxlength="100" required
                                               data-provide="typeahead" autocomplete="off"
                                               name="publisherName" value="{{ $book->publisher->name }}">
                                        <input type="hidden" id="publisherId" name="publisher" value="{{ $book->publisher->id }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="bookISBN10">ISBN 10</label>
                                        <input type="text" class="form-control input-lg" id="bookISBN10" placeholder="ISBN10"
                                               name="isbn10" value="{{ $book->isbn10 }}" maxlength="10" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="bookIsbn13">ISBN13</label>
                                        <input type="text" class="form-control input-lg" id="bookIsbn13" placeholder="ISBN13" maxlength="13" required
                                               name="isbn13" value="{{ $book->isbn13 }}">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="bookISBN10">Shelf</label>
                                        <select class="form-control input-lg" name="shelf">
                                            @foreach($shelfs as $shelf)
                                                <option>{{ $shelf }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="bookIsbn13">Shelf Level</label>
                                        <select class="form-control input-lg" name="shelfLevel">
                                            @foreach($shelfLevels as $level)
                                                <option>{{ $level }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label id="bookCategoryLabel1" for="bookCategory1">Category 1</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg" id="bookCategory1" required
                                                   placeholder="Category 1" maxlength="100" name="category1name"
                                                   data-provide="typeahead" autocomplete="off"
                                                   value="{{ array_key_exists(0, $book->categories()->get()->toArray()) ? $book->categories()->get()->toArray()[0]['title'] :'' }}">
                                            <input type="hidden" id="category1" name="category1"
                                                   value="{{ array_key_exists(0, $book->categories()->get()->toArray()) ? $book->categories()->get()->toArray()[0]['id'] :'' }}">
                                            <div class = "input-group-btn">
                                                <button class = "btn btn-lg btn-default btn-flat clear-category" value="1" type="button"
                                                        data-toggle="tooltip" title="Clear">
                                                    <i class="text-muted fa fa-eraser"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label id="bookCategoryLabel2" for="bookCategory2">Category 2</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg" id="bookCategory2"
                                                   placeholder="Category 2" maxlength="100" name="category2name"
                                                   data-provide="typeahead" autocomplete="off"
                                                   value="{{ array_key_exists(1, $book->categories()->get()->toArray()) ? $book->categories()->get()->toArray()[1]['title'] :'' }}">

                                            <input type="hidden" id="category2" name="category2"
                                                   value="{{ array_key_exists(1, $book->categories()->get()->toArray()) ? $book->categories()->get()->toArray()[1]['id'] :'' }}">
                                            <div class = "input-group-btn">
                                                <button class = "btn btn-lg btn-default btn-flat clear-category" value="2" type="button"
                                                        data-toggle="tooltip" title="Clear">
                                                    <i class="text-muted fa fa-eraser"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label id="bookCategoryLabel3" for="bookCategory3">Category 3</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg" id="bookCategory3"
                                                   placeholder="Category 3" maxlength="100" name="category3name"
                                                   data-provide="typeahead" autocomplete="off"
                                                   value="{{ array_key_exists(2, $book->categories()->get()->toArray()) ? $book->categories()->get()->toArray()[2]['title'] : '' }}">
                                            <input type="hidden" id="category3" name="category3"
                                                   value="{{ array_key_exists(2, $book->categories()->get()->toArray()) ? $book->categories()->get()->toArray()[2]['id'] : '' }}">
                                            <div class = "input-group-btn">
                                                <button class = "btn btn-lg btn-default btn-flat clear-category" value="3" type="button"
                                                        data-toggle="tooltip" title="Clear">
                                                    <i class="text-muted fa fa-eraser"></i></button>
                                            </div>
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