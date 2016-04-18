@extends('app')

@section('content')

	<div class="container">
		<div class="row">

			<div class="col-lg-4"></div>

			<div class="col-lg-4 page-content">

				<br>
				<form class="contact-form" role="form" method="POST" action="{{ url('/auth/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="input-group">
						<p>Email Address:</p>
						<input style="width: 260px" class="form-control" type="email" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}">
					</div>
					
					<br>

					<div class="input-group">
						<p>Password: &nbsp;</p>
						<input style="width: 260px" class="form-control" type="password" id="password" name="password" placeholder="Enter password" value="{{ old('password') }}">
					</div>
					<input type="submit" class="btn btn-default pull-right" value="Log In"/>

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

				<br><br><br>
				<div class="col-50 c">
					<form class="contact-form" method="GET" action="{{ url('/auth/register') }}">
						<p>Not Registered? <input type="submit" class="btn btn-default" value="Sign Up"/></p>
					</form>
				</div>
			</div>

			<div class="col-lg-4"></div>

		</div>

	</div>

@endsection
