@extends('browse')
@section('title') Return Books - {{ $common['appTitle'] }} @stop

@section("content")

    <section id="book-return" class="content">
        <input type="hidden" id="page_token" value="{{ csrf_token() }}">

        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                        <h3 class="box-title">
                            <span class="text-left"><i class="fa fa-shopping-cart"></i> Return Books</span>
                        </h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                        <h3><span class="text-muted">Today:</span> {{ $today }}</h3>
                    </div>
                </div>

            </div>
            <div class="box-body">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}"/>

                <div class="row">
                    <br/>
                    <br/>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th data-toggle="tooltip" title="Reservation Id">Id</th>
                                    <th data-toggle="tooltip" title="Reservation Date">Date</th>
                                    <th>Due Date</th>
                                    <th>Book Info</th>
                                    <th>Authors</th>
                                    <th>Fine</th>
                                    <th class="text-right">..</th>
                                </tr>
                                </thead>
                                <tbody id="book-return-list">
                                @foreach($reservations as $reservation)
                                    <tr id='reservation-id-{{ $reservation->id }}'
                                        class="{{ $reservation->fine() >0 ? 'warning':'' }}">
                                        <td>{{ $reservation->id }}</td>
                                        <td>{{ $reservation->date->format('d M') }}<br/>
                                            <small>{{ $reservation->date->format('Y') }}</small>
                                        </td>
                                        <td> {{ $reservation->getDueDate() }}</br>
                                            {{--<small>In</small> {{ $reservation->dueDate->diffInDays() }} days<br/>--}}
                                            <small class="text-muted">{{ $reservation->dueDate->format('d M, Y') }}</small>
                                        </td>
                                        <td>
                                            <p>
                                                <a href="{{ url('/').'/book/'.$reservation->bookCopy->book->id. '/'.str_slug($reservation->bookCopy->book->title) }}">
                                                    <i class="fa fa-book text-muted"></i> {{ $reservation->bookCopy->book->title }}
                                                </a>
                                                <small class="text-muted">
                                                    - {{ $reservation->bookCopy->book->edition }}</small>
                                            </p>
                                            <p>
                                                <small><span
                                                            class="text-muted">Code:</span> {{ $reservation->bookCopy->bookCode }}
                                                </small>
                                            </p>
                                        </td>
                                        <td>
                                            @foreach($reservation->bookCopy->book->authors as $author)
                                                <a href="{{ url('/').'/author/'.$author->id.'/'.str_slug($author->name) }}"
                                                ><i class="fa fa-user text-muted"></i> {{ $author->name }}</a><br/>
                                            @endforeach

                                        </td>
                                        <td> ${{ $reservation->fine() }}
                                            <input type="hidden" id="fine-for-{{ $reservation->id }}" value="{{  $reservation->fine()}}"/>
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-primary btn-sm btn-book-return dropdown-toggle" type="button" data-toggle="dropdown"
                                                    value="{{ $reservation->id }}">Return
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div id="message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@stop