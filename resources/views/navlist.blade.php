<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">@if(Auth::user()){{Auth::user()->fullName()}}@endif</a>
		</div>
		<ul class="nav navbar-nav pull-right">

		<li class="sub-nav"><a href="/">Home</a></li>
		<li class="sub-nav"><a href="/about">About</a></li>
		<li class="sub-nav"><a href="/contact">Contact</a></li>
		@if(Auth::user())
			<li class="sub-nav"><a href="/logout">Logout</a></li>
		@endif
	</div>
</nav>