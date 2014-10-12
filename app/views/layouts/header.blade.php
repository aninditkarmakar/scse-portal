<?php 
	$titleNotRequired = ['professor-profile']
?>
<div class="row">
	<div class="col-xs-12">
		<div class="header" ng-show="isHeaderVisible()" ng-cloak>
			<ul class="nav nav-pills">
				<li class="">{{ link_to_route('home', 'Home') }}<!--<a href="#">Home</a>--></li>
				<li class="">{{ link_to_route('admin-dashboard','Admin') }}<!--<a href="#">Admin</a>--></li>
				<li class="">{{ link_to_route('professor-profile', 'Professor') }}<!--<a href="#">Professors</a>--></li>
				<li class="">{{ link_to_route('search', 'Search') }}<!--<a href="#">Search</a>--></li>
				@if(Auth::check())
					<li class="pull-right">{{ link_to_route('logout', 'Logout') }}<!--<a href="#">Logout</a>--></li>
				@endif
			</ul>
			@if(!in_array(Route::currentRouteName(), $titleNotRequired))
				<div class="text-center">
					<h1>SCSE Portal</h1>
				</div>
			@endif			
		</div>
	</div>
</div>