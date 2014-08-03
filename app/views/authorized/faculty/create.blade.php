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
		<h2>Add Faculty</h2>
	</div>
</div>

<form>

	<div class="row">
		<div class="large-6 medium-4 columns">
			<label>First Name:</label>
			<input type="text" placeholder="" />
		</div>
		<div class="large-6 medium-4 columns">
			<label>Last Name:</label>
			<input type="text" placeholder="" />
		</div>
	</div>
	<div class="row">
		<div class="large-6 large-offset-3 medium-4 medium-offset-4 columns">
			<label>Faculty Code:</label>
			<input type="text" placeholder="" />
		</div>
	</div>
	<div class="row">
		<div class="large-6 large-offset-3 medium-4 medium-offset-4 columns">
			<label>Email:</label>
			<input type="text" placeholder="" />
		</div>
	</div>
	<div class="row">
		<div class="large-6 large-offset-3 medium-4 medium-offset-4 columns">
			<label>Cabin:</label>
			<input type="text" placeholder="" />
		</div>
	</div>
	<div class="row">
		<div class="large-6 medium-4 columns">
			<label>Password:</label>
			<input type="password" placeholder="" />
		</div>
		<div class="large-6 medium-4 columns">
			<label>Confirm Password:</label>
			<input type="password" placeholder="" />
		</div>
	</div>
	<div="row">
	<div class="large-10 medium-4 text-right">
		<a href="#" class="small round button">Submit</a><br/>
	</div>
</div> 
</div>

</form>

@stop

@section('bottom-scripts')

@stop