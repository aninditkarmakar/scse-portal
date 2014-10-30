<?php 
	$routeName = Route::currentRouteName(); 
?>

<!doctype html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">

	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/modernizr.js')}}"></script>
	@section('header-scripts')

	@show

	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
	<div class="container">
		@section('header')
			@include('layouts.header')
		@show

		@section('body')

		@show

		@section('footer')
		<p><span class="glyphicon glyphicon-heart"></span> from the Yeoman team</p>
		@show
	</div>

	@section('modals')

	@show

	@section('scripts')

	@show
</body>