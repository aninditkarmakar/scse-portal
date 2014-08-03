@extends('layouts.master')

@section('page-title')
<title>Add Faculty | SCSE Portal | VIT</title>
@stop

@section('topbar')
@include('layouts.topbar')
@stop

@section('content')

<div class="row">
	<div class="small-12 columns text-center">        
		<h2>Add Faculty</h2>
	</div>
</div>

{{ Form::open(array('route'=>'faculty.store', 'method'=>'post')) }}

<div class="row">
	<div class="medium-10 medium-offset-1 columns">
		<div class="medium-6 columns">
			<label>First Name:</label>
			<input type="text" name="firstname" placeholder="" />
		</div>
		<div class="medium-6 columns">
			<label>Last Name:</label>
			<input type="text" name="lastname" placeholder="" />
		</div>
	</div>
</div>
<div class="row">
	<div class="large-6 large-offset-3 medium-4 medium-offset-4 columns">
		<label>Faculty Code:</label>
		<input type="text" name="faculty_code" placeholder="" />
	</div>
</div>
<div class="row">
	<div class="large-6 large-offset-3 medium-4 medium-offset-4 columns">
		<label>Email:</label>
		<input type="text" name="email" placeholder="" />
	</div>
</div>
<div class="row">
	<div class="large-6 large-offset-3 medium-4 medium-offset-4 columns">
		<label>Cabin:</label>
		<input type="text" name="cabin" placeholder="" />
	</div>
</div>
<div class="row">
	<div class="medium-10 medium-offset-1 columns">
		<div class="medium-6 columns">
			<label>Password:</label>
			<input type="password" name="password" placeholder="" />
		</div>
		<div class="medium-6 columns">
			<label>Confirm Password:</label>
			<input type="password" name="confirm_password" placeholder="" />
		</div>
	</div>
</div>
<div class="row">
	<div class="small-12 text-center">
		@if($errors->has())
			@foreach($errors->all() as $error)
				<span class="error-message">{{ $error }}</span><br/>
			@endforeach
		@endif
		{{ Form::submit('Submit', array('class'=>'button')) }}
	</div>
</div>

{{ Form::close() }}

@stop

@section('bottom-scripts')

@stop