@extends('app')

@section('content')

	<div class="container page-content">

		@include('auth.register_form_partial', ['doctors' => $doctors])

		<div class="row">
			{{--<div class="col-md-3"><div>--}}

			<div class="col-md-12">
				{{--<br>--}}
				<form method="GET" action="{{ url('/auth/login') }}">
					<p class="pull-right" style="display: inline-block"><strong>Already have an account? </strong><input type="submit" class="btn btn-default" value="Login here"/></p>
				</form>
			</div>

			{{--<div class="col-md-3"><div>--}}
			{{--</div>--}}
		</div>
	</div>
@endsection