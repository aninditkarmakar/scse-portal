@extends('layouts.master')

@section('body')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-6 col-md-offset-3">
			<h3 class="text-muted">Login</h3>
		</div>
		{{ Form::open(array('route'=>'login-post', 'method'=>'post')) }}
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				@foreach($errors->all() as $message)
					<div class="alert alert-danger" role="alert">{{ $message }}</div>
				@endforeach
				<div class="form-group">
					{{ Form::text('username',null, array('class'=>'form-control', 'placeholder'=>'Username', 'required'=>'required')) }}	
				</div>
				<div class="form-group">
					{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password', 'required'=>'required')) }}	
				</div>
				<div class="text-center">
					{{ Form::submit('Login', array('class'=>'btn btn-primary')) }}
					<!--<button type="submit" class="btn btn-primary" class="form-control">Login</button>-->
				</div>
			</div>
		{{ Form::close() }}
	</div>
</div>
@stop