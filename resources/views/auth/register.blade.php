@extends('registration')

@section('content')

	<div class="container reg-content">

		@include('auth.register_form_partial', ['doctors' => $doctors])

		<div class="row">
			<div class="col-md-12">
				<form method="GET" action="{{ url('/auth/login') }}">
					<p class="pull-right page-content" style="display: inline-block"><strong>Already have an account? </strong><input type="submit" class="btn btn-default" value="Login here"/></p>
				</form>
			</div>
		</div>
	</div>
@endsection