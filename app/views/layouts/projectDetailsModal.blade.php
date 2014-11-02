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
			@if($project['filename'] !== null)
			<a href="{{ route('project-pdf-download', ['filename'=>$project['filename']]) }}" target="_blank">Download</a>
			@else 	
				<span>-</span>
			@endif
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
	<div class="col-sm-12 text-center">
		<a href="{{ route('show-project', ['id'=>$project['id']]) }}" class="btn btn-default">Go to project page</a>
	</div>
</div>