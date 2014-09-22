@extends('layouts.master')

@section('page-title')
<title>Welcome | SCSE Portal | VIT</title>
@stop

@section('topbar')
@include('layouts.topbar')
@stop

@section('content')
<div class="row">
	
		@if(Session::has('message'))
			<div class="small-12 columns text-center">
				<span class="success-message">{{ Session::pull('message') }}</span>
			</div>
		@endif
	<div class="small-12 medium-6 columns text-center">
		{{ link_to_route('student.create', 'Add a student', $parameters = array() , $attributes = array('class' => 'button')) }}
	</div>

	<div class="small-12 medium-6 columns text-center">
		{{ link_to_route('faculty.create', 'Add a faculty', $parameters = array() , $attributes = array('class' => 'button')) }}
	</div>
</div>

@stop

@section('bottom-scripts')

@stop