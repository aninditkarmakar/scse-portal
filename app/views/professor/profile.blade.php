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
						<td class="text-center"><a href="#">Abstract</a></td>
					</tr>
					<tr>
						<td>Project 2</td>
						<td class="text-center"><a href="#">Abstract</a></td>
					</tr>
					<tr>
						<td>Project 3</td>
						<td class="text-center"><a href="#">Abstract</a></td>
					</tr>
					<tr>
						<td>Project 4</td>
						<td class="text-center"><a href="#">Abstract</a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

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
</div>
@stop

@section('scripts')
@yield('selector-scripts')
@yield('searchbox-scripts')
@stop