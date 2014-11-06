<?php
	
	$types = array();

	foreach($project_types as $type) {
		$types[$type['id']] = $type['type']; 
	}

?>

@extends('layouts.master')

@section('header-scripts')
	<script type="text/javascript" src="{{asset('js/bootstrap-filestyle.js')}}"> </script>
	<script src="{{asset('js/typeahead.min.js')}}"></script>
@append

@section('body')
	<div id="overlay"></div>
	<div class="container" id="addProjectForm">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h3>Edit Project</h3>
			</div>
	
			<div class="col-xs-10 col-xs-offset-1 text-center">
				@foreach($errors->all() as $message)
					<div class="alert alert-danger" role="alert">{{ $message }}</div>
				@endforeach

				{{ Form::open(array('url'=>route('professor-edit-project-post', ['id'=>$info['id']]), 'files'=>true, 'method'=>'post', 'role'=>'form', 'class'=>'form-horizontal', 'novalidate'=>'novalidate', 'data-parsley-validate'=>'true')) }}
					
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-10">
							{{Form::text('title',$info['title'],array('placeholder'=>'Title', 'class'=>'form-control', 'required'=>'required'))}}
						</div>
					</div>

					<div class="form-group">
						<label for="abstract" class="col-sm-2 control-label">Abstract</label>
						<div class="col-sm-10">	
							{{ Form::textarea('abstract', $info['abstract'], array('class'=>'form-control', 'required'=>'required')) }}
						</div>						
					</div>

					<div class="form-group">
						<label for="type" class="col-sm-2 control-label">Degree Level</label>
						<div class="col-sm-10">
							{{ Form::select('type', $types, $info['type'], ['class'=>'form-control', 'required'=>'required']) }}
						</div>
					</div>

					<div class="form-group">
						<label for="type" class="col-sm-2 control-label">Start Date</label>
						<div class="col-sm-10">
							<input type="date" name="start_date" class="form-control" required value="{{ $info['start_date'] }}"/>
						</div>
					</div>

					<div class="form-group">
						<label for="type" class="col-sm-2 control-label">End Date</label>
						<div class="col-sm-10">
							<input type="date" name="end_date" class="form-control" value="{{ $info['end_date'] }}"/>
						</div>
					</div>

					<div class="form-group">
						<label for="type" class="col-sm-2 control-label">Semester</label>
						<div class="col-sm-10">
							{{ Form::select('semester_id', $semester_list, $info['semester_id'], ['class'=>'form-control', 'required'=>'required']) }}
						</div>
					</div>

					<div class="form-group">
						<label for="file" class="col-sm-2 control-label">PDF File</label>
						<div class="col-sm-10">
							{{ Form::file('file', '', array('class'=>'filestyle', 'data-icon'=>'false', 'required'=>'required')) }}
						</div>
						<input type="hidden" name="file_uploaded" value="{{ isset($info['filename'])?'1':'0' }}"/>
					</div>

					<div class="form-group">
						<label for="students" class="col-sm-2 control-label">Students</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" id="students" name="students" disabled value="{{ $info['student_regnos'] }}"/>
								<div class="input-group-addon addon" id="clear_students">X</div>
							</div>							
						</div>
						<div class="col-sm-10 col-sm-offset-2">
							<div id="remote-students">
								<input class="typeahead form-control" type="text" id="search_input" placeholder="Enter student registration number"/>
							</div>
						</div>
					</div>

					{{ Form::hidden('student_ids', $info['student_ids'], array('id'=>"student_ids")) }}
					
					<div class="form-group">
						<div class="col-sm-12 text-center">
							{{ Form::submit('Save', array('class'=>'btn btn-lg btn-success')) }}
							<a href="{{ route('professor-delete-project', ['id'=>$info['id']]) }}" class="btn btn-lg btn-danger">DELETE</a>
							<a href="{{ route('professor-profile') }}" class="btn btn-lg btn-primary">Cancel</a>
						</div>
					</div>
				{{ Form::close() }}
			</div>

		</div>
	</div>

@stop

@section('scripts')
	<script>
		$(":file").filestyle();

		var searchUrl = "{{ route('search-student-regno') }}"

		var results = new Bloodhound({
			datumTokenizer: function (d) {
	            return Bloodhound.tokenizers.whitespace(d.reg_no);
	        },
	        queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: ''+searchUrl,
				rateLimitWait: 2000
			}
		});

		var resultId;

		results.initialize();
		 
		$('#remote-students .typeahead').typeahead({
			highlight: true,
			hint: true
		}, 
		{
			name: 'search-results',
			displayKey: 'reg_no',
			source: function (query, process) {
				resultId = 0;
				
				return $.get(''+searchUrl, { q: query }, function (data) {
				    return process(data.data);
				});
			},
		  // source: results.ttAdapter()
		});

		$('#search_input').bind('typeahead:selected', function(obj, datum, name) {      
	        console.log(datum.reg_no);
	        $("#students").val($('#students').val()+datum.reg_no+", ");
	        $("#student_ids").val($('#student_ids').val()+datum.id+", ");

	        $('#search_input').val('');
		});

		$("#clear_students").on('click', function() {
			$("#students").val('');
	        $("#student_ids").val('');

	        $('#search_input').clear();
		});
		$('#search_input').on('blur', function() {
			$('#search_input').val('');
		});
	</script>
@stop