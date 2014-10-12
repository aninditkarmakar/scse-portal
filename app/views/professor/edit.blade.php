<?php 
	$weekdays = [
		'Monday'=>'Monday',
		'Tuesday'=>'Tuesday',
		'Wednesday'=>'Wednesday',
		'Thursday'=>'Thursday',
		'Friday'=>'Friday'
	];

	$weekdaysSingle = [
		'Monday',
		'Tuesday',
		'Wednesday',
		'Thursday',
		'Friday'
	];

	$times = array();
	for($i=8;$i<=19;$i++) {
		if($i === 12) {
			$item['label'] = '12pm';
		} else {
			$item['label'] = $i<12?($i.'am'):(($i-12).'pm');
		}
		$item['value'] = $i;
		array_push($times, $item);
	}
	$timesSingle = [
		'8am',
		'9am',
		'10am',
		'11am',
		'12pm',
		'1pm',
		'2pm',
		'3pm',
		'4pm',
		'5pm',
		'6pm',
		'7pm'
	];
?>
@extends('layouts.master')

@section('header-scripts')
	<script src="{{asset('js/rivet.min.js')}}"></script>
	<script>
		var details = {{ json_encode($details) }};
		var weekdays = {{ json_encode($weekdaysSingle) }};
		var times = {{ json_encode($times) }};
		var model = {};
	</script>
@stop
@section('body')
	<div id="overlay"></div>
	<div class="container" id="editForm">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h3 style="margin-top: 5px">Edit Details</h3>
			</div>
<!--
			<form role="form" class="form-horizontal">
				<div class="form-group">
					<label for="firstname" class="col-sm-2 control-label">FirstName</label>
					<div class="col-sm-10">
						{{ Form::input('text', 'firstname', $details['firstName'], ['class'=>'form-control', 'id'=>'firstname', 'placeholder'=>'First Name']) }}
					</div>
				</div>

				<div class="form-group">
					<label for="lastname" class="col-sm-2 control-label">FirstName</label>
					<div class="col-sm-10">
						{{ Form::input('text', 'lastname', $details['lastName'], ['class'=>'form-control', 'id'=>'firstname', 'placeholder'=>'Last Name']) }}
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Free Slots</label>

					<div class="col-sm-10">
						<?php $i=1; ?>
						@foreach ($details['freeSlots'] as $value)
							<div class="col-sm-4">
								{{ Form::select('day'.$i, $weekdays, $value['day'], ['class'=>'form-control']) }}
							</div>
							<div class="col-sm-3">
								{{ Form::select('time'.$i, $times, 9, ['class'=>'form-control']) }}
							</div>
							<div class="col-sm-3">
								{{ Form::select('time'.$i, $times, 9, ['class'=>'form-control']) }}
							</div>
						@endforeach
						@for($k = $i; $k < $i+2; $k++)
							<div class="col-sm-4">
								{{ Form::select('day', $weekdays, 'Monday', ['class'=>'form-control']) }}
							</div>
							<div class="col-sm-3">
								{{ Form::select('time', $times, '8am', ['class'=>'form-control']) }}
							</div>
							<div class="col-sm-3">
								{{ Form::select('time', $times, 8, ['class'=>'form-control']) }}
							</div>
						@endfor
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Specializations</label>
					<div class="col-sm-10">
						<span class="text-muted">Comma separated</span>
						{{ Form::textarea('specializations', null, ['class'=>'form-control']) }}

					</div>
				</div>
			</form>
-->
		<form role="form" class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-2 control-label">First Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" rv-value="details.firstName" placeholder="First Name"/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Last Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" rv-value="details.lastName" placeholder="First Name"/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Free Slots</label>
				<div class="col-sm-10">
					<div rv-each-slot="details.freeSlots">
						<div class="form-group">
							<div class="col-sm-4">
								<span>Day</span>
								<select rv-value="slot.day" class="form-control">
									<option rv-each-day="weekdays" rv-text="day" rv-value="day"></option>
								</select>
							</div>

							<div class="col-sm-3">
								<span>From</span>
								<select rv-value="slot.from" class="form-control">
									<option rv-each-time="times" rv-text="time.label" rv-value="time.value"></option>
								</select>
							</div>

							<div class="col-sm-3">
								<span style="width:100%">To<a href="#" class="pull-right" rv-on-click="controller.removeSlot"><i class="glyphicon glyphicon-remove glyphicon-red"></i></a></span>
								<select rv-value="slot.to" class="form-control">
									<option rv-each-time="times" rv-text="time.label" rv-value="time.value"></option>
								</select>
							</div>
						</div>

						<div class="clearfix"></div>
					</div>
					<div class="col-sm-3 text-center">
						<a class="btn btn-primary" rv-on-click="controller.addSlot">Add Slot</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Specializations</label>
				<div class="col-sm-10">
					<div rv-each-specialization="details.specializations">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" rv-value="specialization.value" placeholder="Specialization"/>
								<div class="input-group-addon"><a href="#" rv-on-click="controller.removeSpecialization">X</a></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-sm-3 text-center">
						<a class="btn btn-primary" rv-on-click="controller.addSpecialization">Add Specialization</a>
					</div>
				</div>
				<br/>
			</div>

			<div class="form-group text-center">
				<a href="#" class="btn btn-success" rv-on-click="controller.save">SAVE</a>
			</div>
		</form>
		</div>
	</div>
@stop

@section('scripts')
<script>
	
	var controller = {
		addSlot: function() {
			model.freeSlots.push({
				"day": "Monday",
				"from": 8,
				"to": 9
			});
		},

		removeSlot: function(event, object) {
			model.freeSlots.splice(object.index, 1);
		},

		addSpecialization: function(event, object) {
			model.specializations.push({
				value: ''
			});
		},

		removeSpecialization: function(event, object) {
			model.specializations.splice(object.index, 1);
		},

		save: function(event, object) {
			$('#overlay').show();
			$.ajax({
				type: "POST",
				url: '{{ route("professor-edit-post") }}',
				data: {
					data: JSON.stringify(model)
				},
				success: function(data, status, xhr) {
					var obj = data;

					if(obj.success === false) {
						$('#overlay').hide();
						alert("FAILED. Please Try Again.");
					} else {
						alert("Success!");
						window.location = "{{ route('professor-profile') }}";
					}
				},
				error: function(xhr, status, err) {
					$('#overlay').hide();
					alert("FAILED. Please Try Again.");
				},
				timeout: 20000
			});
		}
	} 

	model.firstName = details.firstName+'';
	model.lastName = details.lastName+'';
	model.freeSlots = details.freeSlots;
	model.specializations = details.specializations;

	var view = rivets.bind($('#editForm'), {
		details: model,
		controller: controller,
		times: times,
		weekdays: weekdays
	});
</script>
@stop