@extends('../app')

@section('content')

	<section class="row">
		<div class="content clearfix">

			<h1>Reset Password</h1>

			<div class="col-50 c">

				<form class="contact-form" role="form" method="POST" action="{{ url('/password/reset') }}">
				    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="token" value="{{ $token }}">
					<p>Email Address:</p>
				    <input type="email" name="email" value="{{ old('email') }}">
				    <p>Password:</p>
				    <input type="password" name="password">
				    <p>Confirm Password:</p>
				    <input type="password" name="password_confirmation">
				    <p><a href="{{ url('/password/email') }}">Forgot Your Password?</a></p>
				    <input type="submit" class="btn" value="Log In"/>
				</form>
				@if (count($errors) > 0)
	                <div class="alert-danger">
	                    <p><strong>Whoops!</strong> There were some problems with your input.</p>
	                    <ul>
	                        @foreach ($errors->all() as $error)
	                            <li>{{ $error }}</li>
	                        @endforeach
	                    </ul>
	                </div>
	            @endif
			</div>

		</div>
	</section>

@endsection
