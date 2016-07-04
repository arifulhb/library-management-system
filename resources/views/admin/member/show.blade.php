@extends('admin')
@section('title') View Member - {{ $common['appShort'] }} @stop

@section("content")
    <section class="content-header">
        <h1><i class="fa fa-user"></i> Member</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-user"></i> Admin</a></li>
            <li class="">
                <a href="{{ url('/admin/member/list') }}">Member</a>
            </li>
            <li class="active">
                {{ $member->getFullName() }}
            </li>
        </ol>
    </section>

    <section id="createBook" class="content book-form">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-lg-6"><h3 class="box-title">Member Details</h3></div>
                            <div class="col-lg-6 text-right">
                                <span class="text-muted" data-toggle="tooltip" title="{{ $member->created_at->format('d M, Y') }}">
                                    Created {{ $member->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="#" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="mFirstName">First Name</label>
                                        <p class="lead">{{ $member->firstName }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="mLastName">Last Name</label>
                                        <p class="lead">{{ $member->lastName }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="mGender">Gender</label>
                                        <p class="lead">{{ $member->gender }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <p class="lead">{{ $member->dateOfBirth->format('d M, Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Type</label>
                                        <p class="lead">{{ $member->type }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-6 col-sm-12">
                                    <div class="form-group">
                                    <label for="mTitle">Profile Title</label>
                                    <p class="lead">{{ $member->profileTitle }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label >Email</label>
                                        <p class="lead">{{ $member->email }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <p class="">
                                <div class="pull-left">
                                    <span class="text-muted">Last Update: {{ $member->updated_at->format('d M, Y') }} </span>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/admin/').'/member/'.$member->id.'/edit' }}" title="Edit"
                                       data-toggle="tooltip" class="btn btn-primary btn-flat">Edit</a>
                                </div>

                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reservation ({{ $member->reservations()->count() }})</h3>
                    </div>
                    <div class="box-body">
                        @if($member->reservations()->count() > 0)
                            @foreach($member->reservations() as $reservation)
                                <div class="reservation well well-sm">
                                    <p><span class="text-muted"><i class="fa fa-book"></i></span>
                                        <strong class="text-info">{{ $reservation->bookCopy->book->title }}</strong><br/>
                                        <span class="text-muted"><i class="fa fa-barcode"></i> Code:</span>
                                        <span class="text-info">{{ $reservation->bookCopy->bookCode }}</span> <br/>
                                        <span class="text-muted"><i class="fa fa-calendar"></i> Due Date:</span>
                                        <span class="text-info" data-toggle="tooltip" title="tooltip">{{ $reservation->getDueDate() }}
                                        </span>
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-warning"><i class="fa fa-warning"></i> No Active Reservation.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
@stop