@extends('layouts.master')

@section('page-title')
	<title>SCSE Portal | VIT</title>
@stop

@section('stylesheets')
	{{ HTML::style('css/token-input.css') }}
@stop

@section('top-scripts')

@stop

@section('topbar')
	@include('layouts.topbar')
@stop

@section('content')

<div class="row">
	<form id="search_form">
		<div class="row">
			<div class="small-12 medium-8 medium-offset-2 columns">
				<label>Search</label>
				<div id="div_search_faculty" style="display:none">
					<input type="text" id="search_faculty" placeholder="Type Search Word..."/>
				</div>
				<div id="div_search_project">
					<input type="text" id="search_project" placeholder="Type Search Word..." />
				</div>
			</div>
		</div>
		<div class="row">  
			<div class="small-12 medium-8 medium-offset-2 columns">
				<div class="row">
					<div class="small-12 medium-4 columns">
						Search By:
					</div>
					<div class="small-12 medium-8 columns text-left">
						<input type="radio" name="search" value="Contact" id="searchContact"/><label for="searchContact">Contact</label>
						<input type="radio" name="Search" value="Academic" id="searchAcademic"/><label for="searchAcademic">Academic</label>
					</div>
					<div class="small-12 columns text-center">
						<button class="button">Search</button>
					</div>
				</div>
			</div>
		</div>
	</form> 
</div> 

@stop

@section('bottom-scripts')
{{ HTML::script('js/jquery.tokeninput.js') }}
<script>
	$(document).ready(function () {
		var projUrl = "{{ route('search-projects') }}";
		var facUrl = "{{ route('search-faculty') }}";

    	$("#search_faculty").tokenInput(facUrl);
    	$("#search_project").tokenInput(projUrl);
    	$('#searchAcademic').prop('checked', true);

    	$('#searchContact').on('click', function() {
    		$('#div_search_project').hide();
    		$('#searchAcademic').prop('checked', false);
    		$('#div_search_faculty').show();
    		$('#searchContact').prop('checked', true);
    	});

    	$('#searchAcademic').on('click', function() {
    		$('#div_search_faculty').hide();
    		$('#searchContact').prop('checked', false);
    		$('#div_search_project').show();
    		$('#searchAcademic').prop('checked', true);
    	});
	});
</script>
@stop