@extends('app')

@section('content')


	<section class="row">
		<div class="content clearfix">

			<h1>Reset Password</h1>

			<div class="col-50 c">

				<form class="contact-form" role="form" method="POST" action="{{ url('/password/email') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<p>Email Address:</p>
				    <input type="email" name="email" value="{{ old('email') }}">
				    <input type="submit" class="btn" value="Reset Password"/>
				</form>
				@if (session('status'))
					<div class="alert alert-success">
						<p>{{ session('status') }}</p>
					</div>
				@endif
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