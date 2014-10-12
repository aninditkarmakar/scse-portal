@extends('layouts.master')

@section('header')
@overwrite

@section('body')
<div class="container">
	<div class="jumbotron">
		<h1> Welcome to the SCSE Portal!</h1>
		<div class="row">
			<div class="col-md-4 col-xs-12">
				{{ link_to_route('admin-dashboard', 'Admin',null, array('class'=>'btn btn-primary')) }}
				<!--<a href="" class="btn btn-primary">Admin</a>-->
			</div>

			<div class="col-md-4 col-xs-12">
				{{ link_to_route('professor-profile', 'Professor', null, array('class'=>'btn btn-default')) }}
			</div>

			<div class="col-md-4 col-xs-12">
				{{ link_to_route('search', 'Search', null, array('class'=>'btn btn-warning')) }}
			</div> 
		</div>
	</div>	
</div>
@stop