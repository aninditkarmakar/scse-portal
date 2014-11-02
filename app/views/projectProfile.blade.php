@extends('layouts.master')

@section('header-scripts')
	<script type="text/javascript" src="{{asset('js/bootstrap-filestyle.js')}}"> </script>
@append

@section('body')
<div class="container">

	<div class="row">
		<div class="col-xs-12">
			<form role="form">
				<div class="form-group">
					@include('search.selectors')
					@yield('selectors')
					<div class="clearfix"></div>
					<hr/>
					@include('search.searchbox')
					@yield('searchbox')
				</div>
			</form>
		</div>
	</div>

</div>

<div class="container">
	<hr style="margin: 15px"/>

	<div class="row">
		
		<div class="col-xs-12 text-center">
			@foreach($errors->all() as $message)
				<div class="alert alert-danger" role="alert">{{ $message }}</div>
			@endforeach
			<h3 style="margin-top: 5px">Project Details</h3>
		</div>		

		<div >
			<div class="col-md-8 col-md-offset-2">
				<div class="row">
					<div class="col-xs-6">
						<span><strong>Title:</strong></span>
					</div>
					<div class="col-xs-6 text-center">
						<span>{{ $data['title'] }}</span>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-6">
						<span><strong>Lead Professor:</strong></span>
					</div>
					<div class="col-xs-6 text-center">
						<span><a href="{{ route('show-professor-profile',['id'=>$data['professor_id']]) }}">{{ $data['professor_name'] }}</a></span>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-6">
						<span><strong>Type:</strong></span>
					</div>
					<div class="col-xs-6 text-center">
						<span>{{ $data['type'] }}</span>
					</div>
				</div>
				<br/>

				@if($data['start_date'] !== '0000-00-00')
				<div class="row">
					<div class="col-xs-6">
						<span><strong>Start Date:</strong></span>
					</div>
					<div class="col-xs-6 text-center">
						<span>{{ $data['start_date'] }}</span>
					</div>
				</div>
				<br/>
				@endif

				@if($data['end_date'] !== '0000-00-00')
					<div class="row">
						<div class="col-xs-6">
							<span><strong>End Date:</strong></span>
						</div>
						<div class="col-xs-6 text-center">
							<span>{{ $data['end_date'] }}</span>
						</div>
					</div>
					<br/>
				@endif

				@if($data['filename'] !== null)
					<div class="row">
						<div class="col-xs-6">
							<span><strong>PDF File:</strong></span>
						</div>
						<div class="col-xs-6 text-center">
							<span><a href="{{ route('project-pdf-download', ['filename'=>$data['filename']]) }}" target="_blank">Download</a></span>
						</div>
					</div>
					<br/>
				@endif

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 text-center">
			<h3>Students</h3>
		</div>
		@if(count($data['students']) > 0)
			<div class="col-xs-10 col-xs-offset-1">
				<table class="table table-striped table-condensed">
					<thead>
						<tr>
							<th class="text-center">Name</th>
							<th class="text-center">Registration Number</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data['students'] as $student)
							<tr>
								<td><a href="{{ route('show-student-regno', ['regNo'=>$student['reg_no']]) }}"><span>{{ $student['firstname'].' '.$student['lastname'] }}</span></a></td>
								<td class="text-center">
									<span>{{ $student['reg_no'] }}</span>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else 
			<div class="col-xs-6 col-xs-offset-3 text-center">
				<span>No Students</span>
			</div>
		@endif
	</div>
</div>
@stop

@section('scripts')
@yield('selector-scripts')
@yield('searchbox-scripts')

@stop
