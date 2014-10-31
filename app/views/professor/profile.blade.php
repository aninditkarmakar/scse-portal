<?php 
	$data = $details;
	$scholar_link = urlencode($data['name'].' VIT University');
	$publication_file = $data['id'].'_publications.pdf';
?>
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
			<h3 style="margin-top: 5px">Faculty Details
				@if($data['myPage'] === true)
					<a href="{{ route('professor-profile-edit') }}" ><i class="glyphicon glyphicon-edit pull-right"></i></a>
				@endif
			</h3>
		</div>		

		<div >
			<div class="col-xs-12 col-md-8">
				<div class="row">
					<div class="col-xs-4">
						<span><strong>Name:</strong></span>
					</div>
					<div class="col-xs-8 text-center">
						<span>{{ $data['name'] }}</span>
					</div>
				</div>
				<br/>
				@if($data['designation'] !== null)
					<div class="row">
						<div class="col-xs-4">
							<span><strong>Designation:</strong></span>
						</div>
						<div class="col-xs-8 text-center">
							<span>{{ $data['designation'] }}</span>
						</div>
					</div>
					<br/>
				@endif
				<div class="row">
					<div class="col-xs-4">
						<span><strong>Mobile:</strong></span>
					</div>
					<div class="col-xs-8 text-center">
						<span>{{ $data['mobile_no'] }}</span>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-4">
						<span><strong>Email:</strong></span>
					</div>
					<div class="col-xs-8 text-center">
						<span>{{ $data['email'] }}</span>
					</div>
				</div>
				
				<br/>
				<div class="row">
					<div class="col-xs-4">
						<span><strong>Free slots:</strong></span>
					</div>
					<div class="col-xs-8 text-center">
						<ul style="list-style-type: none; padding:0">
							@foreach($data['freeSlots'] as $value)
								<li><span>{{ $value['day'].' '.$value['fromTime'].'-'.$value['toTime'] }}</span></li>
							@endforeach
							<br style="none"/>
						</ul>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-xs-4">
						<span><strong>Specializations:</strong></span>
					</div>
					<div class="col-xs-8 text-center">
						<div>
							@foreach($data['specializations'] as $key=>$value)
								<span>
								@if($key+1 !== count($data['specializations']))
									{{ $value['value'].', ' }}
								@else 
									{{ $value['value'] }}
								@endif
								</span>
							@endforeach
						</div>
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-md-4 text-center">
				<img src="{{asset('images/prof.jpg')}}" class="img-circle"/>
			</div>
		</div>
		@if($data['about_me'] !== null)
			<hr>
			<div class="clearfix"></div>
			<div class="col-xs-12 text-center">
				<h3>About Me</h3>
			</div>
			<div class="col-xs-6 col-md-offset-3 text-center">
				<span>{{ $data['about_me'] }}</span>
			</div>
		@endif
	</div>

	<div class="row">
		<div class="col-xs-12 text-center">
			<h3>Subjects</h3>
		</div>
		<div class="col-xs-12">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="text-center">Subject</th>
						<th class="text-center">Semester</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>CSE235 - Data Structures and Algorithms</td>
						<td>Fall 2014-15</td>
					</tr>
					<tr>
						<td>CSE236 - Object Oriented Paradigm and Programming</td>
						<td>Winter 2013-14</td>
					</tr>
					<tr>
						<td>CSE232 - Algorithm Design and Analysis</td>
						<td>Fall 2013-14</td>
					</tr>
					<tr>
						<td>CSE231 - Soft Computing</td>
						<td>Fall 2013-14</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 text-center">
			<h3>
				Projects
				@if($data['myPage'] === true)
					<a href="{{ route('professor-add-project') }}"><i class="glyphicon glyphicon-plus pull-right"></i></a>
				@endif
			</h3>
			
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
									@if($data['myPage'] === true)
										<div class="pull-right" id="edit_{{ $project['id'] }}">
											<a href="{{ route('professor-edit-project', ['id'=>$project['id']]) }}"><i class="glyphicon glyphicon-edit"></i></a>
										</div>
									@endif
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
		
		<!--
		<div class="col-xs-10 col-xs-offset-1">
			<table class="table table-striped table-condensed">
				<thead>
					<tr>
						<th class="text-center">Title</th>
						<th class="text-center">Abstract</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Project 1</td>
						<td class="text-center" id="project_1">
							<a href="#">Abstract</a>
							@if($data['myPage'] === true)
								<div class="pull-right" id="edit_1">
									<span>edit</span>
								</div>
							@endif
						</td>
					</tr>
					<tr>
						<td>Project 2</td>
						<td class="text-center" id="project_2">
							<a href="#">Abstract</a>
							<div class="pull-right" id="edit_2">
								<span>edit</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Project 3</td>
						<td class="text-center" id="project_3">
							<a href="#">Abstract</a>
							<div class="pull-right" id="edit_3">
								<span>edit</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>Project 4</td>
						<td class="text-center" id="project_4">
							<a href="#">Abstract</a>
							<div class="pull-right" id="edit_4">
								<span>edit</span>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		-->
	</div>

	<div class="row">
		<div class="col-xs-12 text-center">
			<h3>Publications</h3>
		</div>
		<div class="col-xs-12 text-center">
			<a href="http://scholar.google.com/scholar?q={{$scholar_link}}" class="btn btn-primary" target="_blank">Google Scholar</a>
			<a href="{{ route('publications-pdf-download', $publication_file) }}" class="btn btn-default" target="_blank">Download</a>
			@if($data['myPage'] === true)
			<button class="btn btn-default" class="btn btn-danger" data-toggle="modal" data-target="#publication_upload">Upload List</button>
			@endif

<!--
			<table class="table table-striped table-condensed">
				<thead>
					<tr>
						<th class="text-center">Title</th>
						<th class="text-center">Link</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Paper 1</td>
						<td class="text-center"><a href="#">Abstract</a></td>
					</tr>
					<tr>
						<td>Paper 2</td>
						<td class="text-center"><a href="#">Abstract</a></td>
					</tr>
					<tr>
						<td>Paper 3</td>
						<td class="text-center"><a href="#">Abstract</a></td>
					</tr>
					<tr>
						<td>Paper 4</td>
						<td class="text-center"><a href="#">Abstract</a></td>
					</tr>
				</tbody>
			</table>
-->
		</div>
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
					<p>{{ $project['project_abstract']['abstract'] }}</p>
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
					<div class="row">
						<div class="col-sm-7">
							<div class="col-sm-3"><label class="control-label">Type:</label></div>
							<div class="col-sm-9"><span>{{ $project['project_type']['type'] }}</span></div>
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
										<td>{{$student['firstname'].' '.$student['lastname'].' ('.$student['reg_no'].')'}}</td>
									</tr>
								@endforeach
							</table>

						</div>
					</div>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	@endforeach

	@if($data['myPage'] === true) 

	<div class="modal fade" id="publication_upload" aria-labelledby="publication_upload" aria-hidden="true">

		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Upload a PDF File</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							{{ Form::open(['route'=>'professor-upload-publications', 'method'=>'POST', 'files'=>true, 'role'=>'form', 'class'=>'form-horizontal']) }}

							<div class="form-group">
								<label for="publications" class="col-sm-2 control-label">PDF File</label>
								<div class="col-sm-10">
									{{ Form::file('publications', '', array('class'=>'filestyle', 'data-icon'=>'false', 'required'=>'required')) }}
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-12 text-center">
									{{ Form::submit('Add it', array('class'=>'btn btn-lg btn-primary')) }}
									<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">CANCEL</button>
								</div>
							</div>

							{{ Form::close() }}
						</div>
					</div>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
	@endif
@stop

@section('scripts')
@yield('selector-scripts')
@yield('searchbox-scripts')

@if($data['myPage'] === true)
	<script>
		@foreach($data['projects'] as $project) 
			$('#edit_{{ $project["id"] }}').hide();
			$('#project_{{ $project["id"] }}').hover(function() {
				$('#edit_{{ $project["id"] }}').show()
			}, function() {
				$('#edit_{{ $project["id"] }}').hide();
			});
		@endforeach
	</script>	
@endif

@stop
