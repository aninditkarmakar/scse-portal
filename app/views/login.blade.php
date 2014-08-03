@extends('layouts.master')

@section('page-title')
	<title>Login | SCSE Portal | VIT</title>
@stop

@section('topbar')
	@include('layouts.topbar')
@stop

@section('content')

<div class="row container">
	<div class="small-12 medium-8 medium-offset-2 columns">
		<h1>Login</h1>
		@if(Session::has('login-error'))
			<span class="error-message">{{ Session::pull('login-error') }}</span>
		@endif
		{{ Form::open(array('route'=>'login.store', 'method'=>'post')) }}
			{{ Form::text('faculty_code', null, array('placeholder' => 'Faculty code')) }}
			{{ Form::password('password', array('placeholder' => 'Password')) }}
			<div class="text-center">
				{{ Form::submit('Login', array('class'=>'button')) }}
			</div>				
		{{ Form::close() }}
	</div>
</div>

@stop

@section('bottom-scripts')

</script>
@stop