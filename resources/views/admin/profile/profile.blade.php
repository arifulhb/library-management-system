@extends('admin')
@section('title') Profile - {{ $common['appShort'] }} @stop

@section("content")
    <section class="content">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-8 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header with-border"><h3 class="box-title">Profile</h3></div>
                    <div class="box-body">
                        @include('common.profile.profile')
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop