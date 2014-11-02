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
			<h3 style="margin-top: 5px">Student Details</h3>
		</div>		

		<div >
			<div class="col-md-8 col-md-offset-2">
				<div class="row">
					<div class="col-xs-6">
						<span><strong>Name:</strong></span>
					</div>
					<div class="col-xs-6 text-center">
						<span>{{ $data['name'] }}</span>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-6">
						<span><strong>Registration Number:</strong></span>
					</div>
					<div class="col-xs-6 text-center">
						<span>{{ $data['reg_no'] }}</span>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-6">
						<span><strong>Email:</strong></span>
					</div>
					<div class="col-xs-6 text-center">
						<span>{{ $data['email'] }}</span>
					</div>
				</div>
				<br/>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 text-center">
			<h3>Projects</h3>
		</div>
		@if(count($data['projects']) > 0)
			<div class="col-xs-10 col-xs-offset-1">
				<table class="table table-striped table-condensed">
					<thead>
						<tr>
							<th class="text-center">Title</th>
							<th class="text-center">Abstract</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data['projects'] as $project)
							<tr id="project_{{ $project['id'] }}">
								<td><a href="#" data-toggle="modal" data-target="#proj_detail_{{$project['id']}}">{{ $project['title'] }}</a></td>
								<td class="text-center">
									<button class="btn btn-default" data-toggle="modal" data-target="#abstract_{{$project['id']}}">Abstract</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else 
			<div class="col-xs-6 col-xs-offset-3 text-center">
				<span>No Projects</span>
			</div>
		@endif
	</div>
</div>
@stop

@section('modals')
	@foreach($data['projects'] as $project)
	<div class="modal fade" id="abstract_{{$project['id']}}" aria-labelledby="abstract_{{$project['id']}}" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">{{$project['title']}}</h4>
				</div>
				<div class="modal-body">
					<p>{{ $project['abstract'] }}</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="proj_detail_{{$project['id']}}" aria-labelledby="proj_detail_{{$project['id']}}" aria-hidden="true">
		<div class="modal-dialog project_modal">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">{{$project['title']}}</h4>
				</div>
				<div class="modal-body">
					@include('layouts.projectDetailsModal', array('project'=>$project))
				<!--
					<div class="row">
						<div class="col-sm-7">
							<div class="col-sm-3"><label class="control-label">Type:</label></div>
							<div class="col-sm-9"><span>{{ $project['type'] }}</span></div>
							<div class="clearfix"></div>
							
							<div class="col-sm-3"><label class="control-lavel">Start Date:</label></div>
							<div class="col-sm-9">{{ $project['start_date'] }}</div>
							<div class="clearfix"></div>
								
							@if($project['end_date'] !== '0000-00-00')
							<div class="col-sm-3"><label class="control-lavel">End Date:</label></div>
							<div class="col-sm-9">{{ $project['end_date'] }}</div>
							<div class="clearfix"></div>
							@endif

							<div class="col-sm-3"><label class="control-lavel">PDF File:</label></div>
							<div class="col-sm-9">
								<a href="{{ route('project-pdf-download', ['filename'=>$project['filename']]) }}" target="_blank">Download</a>
							</div>
							<div class="clearfix"></div>

						</div>
						<div class="col-sm-5">
							
							<table class="table-striped">
								<th>Students</th>
								@if(count($project['students']) === 0)
									<tr><td>-</td></tr>
								@endif
								@foreach($project['students'] as $student)
									<tr>
										<td>
											<a href="{{ route('show-student-regno', ['regNo'=>$student['reg_no']]) }}">
												{{$student['firstname'].' '.$student['lastname'].' ('.$student['reg_no'].')'}}
											</a>
										</td>
									</tr>
								@endforeach
							</table>

						</div>
					</div>
				-->
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	@endforeach
@stop

@section('scripts')
@yield('selector-scripts')
@yield('searchbox-scripts')

@stop
