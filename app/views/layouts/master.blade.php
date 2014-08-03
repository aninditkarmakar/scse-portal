<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	@section('page-title')
	<title>Master</title>
	@show

	{{ HTML::style('css/foundation.css') }}
	{{ HTML::style('css/style.css') }}

	@section('stylesheets')

	@show
	{{ HTML::script('js/vendor/modernizr.js') }}

	@section('top-scripts')

	@show
</head>
<body>
	@section('topbar')

	@show

	<div class="content">
		@section('content')

		@show
	</div>
	@section('footer')

	@show

	{{ HTML::script('js/vendor/jquery.js') }}
	{{ HTML::script('js/foundation.min.js') }}
	@section('bottom-scripts')

	@show
</body>
</html>
