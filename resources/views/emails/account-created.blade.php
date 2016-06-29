<p>Dear {{ $user->getFullName() }}</p>

<p>We are pleased to inform you that, one of our Admin has created a <strong>{{ $user->type }}</strong> account for you in LMS. You can
Login to LMS with your this email <strong>{{ $user->email }}</strong> address. Your Initial Password is your email address. Please change
the password once you logged in there.</p>

<p>You cal login to LMS form here <a href="{{ url('/') }}">LMS Portal</a></p>
<br/>
<p>Thanks</p>
<p>LMS Team</p>