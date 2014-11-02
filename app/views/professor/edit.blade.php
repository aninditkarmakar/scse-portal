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

	$buildings = array(
			['label'=>'CBMR','value'=>'CBMR'],
			['label'=>'CDMM','value'=>'CDMM'],
			['label'=>'GDN','value'=>'GDN'],
			['label'=>'MB','value'=>'MB'],
			['label'=>'SJT','value'=>'SJT'],
			['label'=>'SJT Annex','value'=>'SJT Annex'],
			['label'=>'SMV','value'=>'SMV'],
			['label'=>'TT','value'=>'TT'],
			['label'=>'TT Annex','value'=>'TT Annex'],
		);
?>
@extends('layouts.master')

@section('header-scripts')
	<script src="{{asset('js/rivet.min.js')}}"></script>
	<script>
		var details = {{ json_encode($details) }};
		var weekdays = {{ json_encode($weekdaysSingle) }};
		var times = {{ json_encode($times) }};
		var buildings = {{ json_encode($buildings) }};
		var model = {};
	</script>
@append
@section('body')
	<div id="overlay"></div>
	<div class="container" id="editForm">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h3 style="margin-top: 5px">Edit Details</h3>
			</div>
			<form action="#" role="form" class="form-horizontal" id="form_edit" novalidate data-parsley-validate>
				<div class="form-group">
					<label class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" rv-value="details.firstName" placeholder="First Name" data-parsley-required/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" rv-value="details.lastName" placeholder="Last Name" data-parsley-required/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Cabin</label>
					<div class="col-sm-3">
						<select rv-value="details.cabin.building" class="form-control" data-parsley-required>
							<option rv-each-building="buildings" rv-text="building.label" rv-value="building.value"></option>
						</select>
					</div>
					<div class="col-sm-3">
						<input type="text" id="room" maxlength="10" class="form-control" rv-value="details.cabin.room" placeholder="Room" data-parsley-required data-parsley-type="digits"/>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" rv-value="details.cabin.cabin" placeholder="Cabin" data-parsley-type="alphanum"/>
					</div>					
				</div>

			<div class="col-sm-12 form-group">
				<label for="mobile" class="col-sm-2 control-label">Mobile</label>
				<div class="col-sm-10">
					<input type="text" id="mobile_no" class="form-control" rv-value="details.mobile_no" placeholder="Mobile (No leading zero)" data-parsley-type="digits" data-parsley-maxlength="10" />
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
								<input type="text" class="form-control" rv-value="specialization.value" placeholder="Specialization"/data-parsley-required>
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

			<div class="form-group">
				<label for="about_me" class="col-sm-2 control-label">About Me</label>
				<div class="col-sm-10">
					<textarea id="about_me" class="form-control" rv-value="details.about_me" placeholder="About Me" data-parsley-maxlength="1000"></textarea>
				</div>
			</div>

			<div class="form-group text-center">
				<button type="submit" class="btn btn-success">SAVE</button>
				<a href="#" class="btn btn-danger" rv-on-click="controller.cancel">CANCEL</a>
			</div>
		</form>
	</div>
</div>
@stop

@section('scripts')
<script>
	$(document).ready(function() {
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
			},

			cancel: function(event, object) {
				window.location = "{{ route('professor-profile') }}";
			}
		} 

		model.firstName = details.firstName+'';
		model.lastName = details.lastName+'';
		model.freeSlots = details.freeSlots;
		model.specializations = details.specializations;
		model.cabin = details.cabin;
		model.mobile_no = details.mobile_no;
		model.about_me = details.about_me;


		var view = rivets.bind($('#editForm'), {
			details: model,
			controller: controller,
			times: times,
			weekdays: weekdays,
			buildings: buildings
		});

    $('#form_edit').parsley().subscribe('parsley:form:validate', function (formInstance) {
    	formInstance.submitEvent.preventDefault();
    	if (formInstance.isValid()) {
	      console.log("valid!");
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
    });

    $('#room').keypress(function(ev) {
			if(!(event.keyCode >= 48 && event.keyCode <= 57)) {
				ev.preventDefault();
			}
			if($('#room').val().length >= 3) {
				ev.preventDefault();
			}
		});

		$('#mobile_no').keypress(function(ev) {
			if(!(event.keyCode >= 48 && event.keyCode <= 57)) {
				ev.preventDefault();
			}
			if($('#mobile_no').val().length === 0 && event.keyCode == 48) {
				ev.preventDefault();
			} 
			if($('#mobile_no').val().length >= 10) {
				ev.preventDefault();
			}
		});
	});
</script>
@stop