@extends('browse')
@section('title')
	Register - {{ $common['app'] }}
@stop
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register as Member</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-vertical" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="control-label">First Name</label>
									<input type="text" class="form-control input-lg" name="firstName" value="{{ old('firstName') }}"
										   maxlength="50" required placeholder="First Name">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="control-label">Last Name</label>
									<input type="text" class="form-control input-lg" name="lastName" value="{{ old('lastName') }}"
										   maxlength="50" required placeholder="Last Name">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="control-label">E-Mail Address</label>
									<input type="email" class="form-control" name="email" value="{{ old('email') }}"
									maxlength="30" required placeholder="Email">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12"></div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="control-label">Gender</label>
									<select class="form-control" name="gender" required>
										<option>Male</option>
										<option>Female</option>
										<option>Other</option>
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="control-label">Date of Birth</label>
									<input type="text" class="form-control date-picker" name="dateOfBirth"
										   	value="{{ old('dateOfBirth') }}" maxlength="50" required
											placeholder="Date Of Birth">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="control-label">Password</label>
									<input type="password" class="form-control" name="password" required maxlength="20">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
									<label class="control-label">Confirm Password</label>
									<input type="password" class="form-control" name="password_confirmation"
									required maxlength="20">
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-12 text-right">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
