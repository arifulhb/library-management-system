@if(Session::has('status'))
    <div class="alert alert-success">
        <p><strong>Great!</strong> Profile Updated Successfully.</p>
    </div>
@endif

<form method="post" action="{{ url('/').'/admin/change-password' }}" enctype="application/x-www-form-urlencoded"
class="form-vertical">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group">
                <label>Email</label>
                <label class="form-control input-lg">{{ $user->email }}</label>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" class="form-control input-lg"
                       maxlength="20" required/>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control input-lg"
                       maxlength="20" required/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 text-right">
            <button class="btn btn-info" type="submit">Update</button>
        </div>
    </div>
</form>