@extends('layouts.master')

@section('page-title')
<title>Welcome | SCSE Portal | VIT</title>
@stop

@section('topbar')
@include('layouts.topbar')
@stop

@section('content')

<div class="row">
	<div class="small-12 columns text-center">        
		<h2>Add Student</h2>
	</div>
</div>
{{ Form::open(array('route'=>'student.store', 'method'=>'post')) }}

	<div class="row">
		<div class="large-6 medium-4 columns">
			<label>First Name:</label>
			<input type="text" name="firstname" placeholder="" />
		</div>
		<div class="large-6 medium-4 columns">
			<label>Last Name:</label>
			<input type="text" name="lastname" placeholder="" />
		</div>
	</div>
	<div class="row">
		<div class="large-6 medium-4 columns">
			<label>Registration Number:</label>
			<input type="text" name="reg_no" placeholder="" />
		</div>
	</div>
	<div class="row">
		<div class="large-6 medium-4 columns">
			<label>Email:</label>
			<input type="text" name="email" placeholder="" />
		</div>
	</div>
	<div="row">
	<div class="small-12 text-center">
		@if($errors->has())
			@foreach($errors->all() as $error)
				<span class="error-message">{{ $error }}</span><br/>
			@endforeach
		@endif
		{{ Form::submit('Submit', array('class'=>'button')) }}
	</div>
</div> 
</div>

{{ Form::close() }}
@stop

@section('bottom-scripts')

@stop