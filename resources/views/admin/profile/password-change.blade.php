@extends('admin')
@section('title') Password Change - {{ $common['appShort'] }} @stop

@section("content")
    <section class="content">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header with-border"><h3 class="box-title">Password Change</h3></div>
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
                        @include('common.profile.change-password')
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop