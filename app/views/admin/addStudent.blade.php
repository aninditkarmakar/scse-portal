@extends ('layouts.master')

@section('body')
<div class="container">
	@foreach($errors->all() as $message)
		<div class="alert alert-danger" role="alert">{{ $message }}</div>
	@endforeach
	@if(Session::has('success'))
		<?php $success= Session::get('success') ?>
		<div class="row">
			<div class="col-xs-12">
				<h4>Student has been added successfully!</h4>
			</div>
		</div>
		<hr/>
	@endif
	{{ Form::open(array('route'=>'add-student-post', 'method'=>'post')) }}
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label>Registration Number</label>
					{{ Form::input('text','reg_no', null, array('class'=>'form-control', 'placeholder'=>'Registration Number', 'required'=>'required')) }}
					<!--<input type="number" id="fac_code" class="form-control" placeholder="Faculty Code"/>-->
				</div>

				<div class="row">
					<div class="col-xs-12 col-md-6">
						<div class="form-group">
							<label>First Name</label>
							{{ Form::input('text', 'first_name', null, array('class'=>'form-control', 'placeholder'=>'First Name', 'required'=>'required')) }}
						</div>
					</div>

					<div class="col-xs-12 col-md-6">
						<div class="form-group">
							<label>Last Name</label>
							{{ Form::input('text', 'last_name', null, array('class'=>'form-control', 'placeholder'=>'Last Name', 'required'=>'required')) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label>Email</label>
					{{ Form::input('email', 'email', null, array('class'=>'form-control', 'placeholder'=>'Email', 'required'=>'required')) }}
				</div>

				<div class="text-center">
					{{ Form::submit('Submit', array('class'=>'btn btn-lg btn-primary')) }}
					<!--<button type="submit" class="btn btn-lg btn-primary" class="form-control">Submit</button>-->
				</div>
			</div>
		</div>
	{{ Form::close() }}
</div>
@stop