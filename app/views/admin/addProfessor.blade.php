<?php
	$buildings = array(
			'CBMR' => 'CBMR',
			'CDMM' => 'CDMM',
			'GDN' => 'GDN',
			'MB' => 'MB',
			'SJT' => 'SJT',
			'SJT-Annex' => 'SJT-Annex',
			'SMV' => 'SMV',
			'TT' => 'TT',
			'TT-Annex'=>'TT-Annex',
		);
?>

@extends ('layouts.master')

@section('body')
<div class="container">
	@foreach($errors->all() as $message)
		<div class="alert alert-danger" role="alert">{{ $message }}</div>
	@endforeach
	@if(Session::has('credentials'))
		<?php $credentials= Session::get('credentials') ?>
		<div class="row">
			<div class="col-xs-12">
				<h4>Professor has been added successfully!</h4>
				<span><strong>Username:&nbsp;</strong>{{ $credentials['username'] }}<br/>
				<span><strong>Password:&nbsp;</strong>{{ $credentials['password'] }}
			</div>
		</div>
		<hr/>
	@endif
	{{ Form::open(array('route'=>'add-professor-post', 'method'=>'post', 'data-parsley-validate'=>'data-parsley-validate', 'novalidate'=>'novalidate')) }}
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label>Faculty Code</label>
					{{ Form::input('number','fac_code', null, array('class'=>'form-control', 'placeholder'=>'Faculty Code', 'required'=>'required', 'data-parsley-maxlength'=>'5')) }}
					<!--<input type="number" id="fac_code" class="form-control" placeholder="Faculty Code"/>-->
				</div>

				<div class="row">
					<div class="col-xs-12 col-md-2">
						<div class="form-group">
							<label>Designation</label>
							{{ Form::input('text', 'designation', null, array('class'=>'form-control', 'placeholder'=>'Designation', 'required'=>'required')) }}
						</div>
					</div>

					<div class="col-xs-12 col-md-5">
						<div class="form-group">
							<label>First Name</label>
							{{ Form::input('text', 'first_name', null, array('class'=>'form-control', 'placeholder'=>'First Name', 'required'=>'required')) }}
						</div>
					</div>

					<div class="col-xs-12 col-md-5">
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

				<div class="form-group">
					<label>Cabin</label>
					<div class="clearfix"></div>
					<div class="col-sm-3">
						{{ Form::select('building', $buildings, 'SJT', ['class'=>'form-control', 'required'=>'required']) }}
					</div>
					<div class="col-sm-3">
						{{ Form::input('text', 'room', null, array('class'=>'form-control', 'placeholder'=>'Room No', 'required'=>'required', 'maxlength'=>'3')) }}
					</div>
					<div class="col-sm-6">
						{{ Form::input('text', 'cabin', null, array('class'=>'form-control', 'placeholder'=>'Cabin No.', 'required'=>'required')) }}
					</div>					
				</div>

				<div class="form-group">
					<label>Mobile</label>
					{{ Form::input('text', 'mobile_no', null, array('class'=>'form-control', 'placeholder'=>'Mobile (No leading zero)', 'required'=>'required', 'maxlength'=>'10', 'data-parsley-type'=>'integer')) }}
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