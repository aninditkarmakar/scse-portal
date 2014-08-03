@extends('layouts.master')

@section('page-title')
	<title>SCSE Portal | VIT</title>
@stop

@section('stylesheets')
	{{ HTML::style('css/token-input.css') }}
@stop

@section('top-scripts')
	{{ HTML::script('js/jquery.tokeninput.js') }}
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
				<input type="text" id="search_input" placeholder="Type Search Word..." />
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
<script>
	$(document).ready(function () {
    	$("#search_input").tokenInput("{{route('search-projects')}}");
	});
</script>
@stop