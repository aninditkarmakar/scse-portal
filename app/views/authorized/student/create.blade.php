@extends('layouts.master')

@section('page-title')
<title>Welcome | SCSE Portal | VIT</title>
@stop

@section('topbar')
@include('layouts.topbar')
@stop

@section('content')

<div class="row">        
	<h5>Add Student:</h5>
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
		<div class="large-6 medium-4 columns">
			<label>Registration Number:</label>
			<input type="text" placeholder="" />
		</div>
	</div>
	<div class="row">
		<div class="large-6 medium-4 columns">
			<label>Email:</label>
			<input type="text" placeholder="" />
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