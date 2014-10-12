@extends('layouts.master')

@section('body')
<div class="container">
	
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<a href="{{ route('add-professor') }}">
				<button class="btn admin-btn" id="btn_add_teacher">
					<span>ADD TEACHER</span>
				</button>
			</a>
		</div>

		<div class="col-xs-12 col-md-6">
			<a href="#">
				<button class="btn admin-btn" id="btn_add_student">
					<span>ADD STUDENT</span>
				</button>
			</a>
		</div>
	</div>

</div>
@stop

@section('scripts')
	<script>
		// $('#btn_add_teacher').click(function() {
		// 	window.location="{{ route('add-professor') }}"
		// });
	</script>
@stop