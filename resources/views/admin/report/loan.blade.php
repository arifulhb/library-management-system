@extends('admin')
@section('title') Loan Report - {{ $common['appTitle'] }} @stop

@section("content")
    <section class="content-header">
        <h1><i class="fa fa-pie-chart"></i> Loan Report <small></small></h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-user"></i> Admin</a></li>
            <li class="">
                <a href="{{ url('/admin/report') }}">Report</a>
            </li>
            <li class="active">
                Loan
            </li>
        </ol>
    </section>

    <section class="content report report-loan">
        <input type="hidden" id="page_token" value="{{ csrf_token() }}">
        <div class="row">
            <form action="{{ url('/admin/report/loan') }}">
            <div class="col-lg-offset-2 col-lg-4 col-md-8 col-sm-12">
                <div class="form-group">
                    <label><h4>Select Date</h4></label>
                    <div class="input-daterange input-group" id="datepicker">
                        <input type="text" class="form-control date-picker" name="start"
                               id="loan-from-date" placeholder="From" value="{{ Input::get('start') }}" required/>
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control date-picker" name="end"
                               to="loan-to-date" placeholder="To" value="{{ Input::get('end') }}" required/>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="form-group">
                    <label><h4>Get Report</h4></label><br/>
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 col-md-12 col-sm-12">
                <div id="printableArea" class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Book Loan Report from {{ Input::get('start') }} to {{ Input::get('end') }}</h3>
                        @if(isset($reservations))
                            <span class="pull-right"><button class="btn btn-default btn-print" type="button"
                                                         onclick="printDiv('printableArea')">
                                <i class="fa fa-print"></i> Print</button></span>
                        @endif
                    </div>
                    <div class="box-body">
                        @if(isset($reservations))

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Reservations</span>
                                            <span class="info-box-number">{{ $reservations->count() }}<small></small></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Members</span>
                                            <span class="info-box-number">{{ $reservations->unique('member_id')->count() }}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12"></div>
                                <div class="col-lg-3 col-md-3 col-sm-12"></div>
                            </div>


                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Time</th>
                                    <th>Member</th>
                                    <th>Book</th>
                                    <th>Code</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                    @foreach($reservations as $reservation)
                                        <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->created_at->format('d M, Y h:i A') }}</td>
                                    <td>{{ $reservation->member->getFullName() }}</td>
                                    <td>{{ $reservation->bookCopy->book->title }} -
                                        <small>{{ $reservation->bookCopy->book->edition }}</small></td>
                                    <td>{{ $reservation->bookCopy->bookCode }}</td>
                                    <td>{{ $reservation->dueDate->format('d M, Y') }}</td>
                                </tr>
                                    @endforeach

                            </tbody>

                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@stop