@if(Session::has('status'))
    <div class="alert alert-success">
        <p><strong>Great!</strong> Profile Updated Successfully.</p>
    </div>
@endif

<form method="post" action="{{ url('/').'/admin/my-profile' }}" enctype="application/x-www-form-urlencoded"
class="form-vertical">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstName" value="{{ $user->firstName }}" class="form-control input-lg"
                       placeholder="First Name" maxlength="50" required/>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastName" value="{{ $user->lastName }}" class="form-control input-lg"
                       placeholder="First Name" maxlength="50" required/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group">
                <label>Email</label>
                <label class="form-control input-lg">{{ $user->email }}</label>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-12">
            <div class="form-group">
                <label>Gender</label>
                <select class="form-control input-lg" name="gender" required>
                    <option {{ $user->gender=='Male'?'SELECTED':'' }}>Male</option>
                    <option {{ $user->gender=='Female'?'SELECTED':'' }}>Female</option>
                    <option {{ $user->gender=='Female'?'Other':'' }}>Other</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="text" name="dateOfBirth" value="{{ $user->dateOfBirth->format('d M Y') }}"
                       class="form-control input-lg date-picker" placeholder="Date of Birth" maxlength="50" required/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label>Profile Title</label>
                <input type="text" name="profileTitle" value="{{ $user->profileTitle }}"
                       class="form-control input-lg" placeholder="Profile Title" maxlength="10" required/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-right">
            <button class="btn btn-info" type="submit">Update</button>
        </div>
    </div>
</form>