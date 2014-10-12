@extends ('layouts.master')

@section('body')
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="text-center"><span>Search By:</span></div><br/>
			<div class="clearfix"></div>

			@include('search.selectors')
			@yield('selectors')
			
			<div class="clearfix"></div>
			<hr/>

			@include('search.searchbox')
			@yield('searchbox')

		
		</div>
		<!--
		<div class="clearfix"></div>
		<hr>

		<div class="col-xs-12">
			@include('search.searchbox')
			@yield('searchbox')
			<div class="form-group">
				<div id="remote">
					<input class="typeahead form-control" type="text" placeholder="Enter search term"/>
				</div>
			</div>
			
		</div> -->
	</div>
</div>
@stop

@section('scripts')
	<!--<script src="js/bootstrap3-typeahead.js"></script>-->
	@yield('selector-scripts')
	@yield('searchbox-scripts')
@stop