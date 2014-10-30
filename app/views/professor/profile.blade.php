<?php 
	$data = $details;
?>
@extends('layouts.master')
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
			<h3 style="margin-top: 5px">Faculty Details
				@if($data['myPage'] === true)
					<a href="{{ route('professor-profile-edit') }}" ><i class="glyphicon glyphicon-edit pull-right"></i></a>
				@endif
			</h3>
		</div>		

		<div ng-hide="edit.detail">
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
								<td><a href="{{ URL::route('project-pdf-download', array('filename'=>$project['filename'])) }}">{{ $project['title'] }}</a></td>
								<td class="text-center">
									<button class="btn btn-default" data-toggle="modal" data-target="#abstract_{{$project['id']}}">Abstract</button>
									@if($data['myPage'] === true)
										<div class="pull-right" id="edit_{{ $project['id'] }}">
											<span>edit</span>
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
		@if($data['myPage'] === true)
			<div class="col-xs-6 col-xs-offset-3 text-center">
				<a href="{{ route('professor-add-project') }}" class="btn btn-primary">Add Project</a>
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
<!--
	<div class="row">
		<div class="col-xs-12 text-center">
			<h3>Publications</h3>
		</div>
		<div class="col-xs-10 col-xs-offset-1">
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
		</div>
	</div>
-->
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
	@endforeach
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
