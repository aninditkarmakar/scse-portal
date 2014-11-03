<?php 
$titleNotRequired = ['professor-profile']
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<img class="navbar-brand logo" src="{{asset('images/logo2.png')}}" />
			<a class="navbar-brand brand-text" href="#">SCSE Portal</a>
		</div>
		<!--<div class="container">-->
			<ul class="nav navbar-nav navbar-left">
				<li class="">{{ link_to_route('home', 'Home') }}</li>
				<li class="">{{ link_to_route('admin-dashboard','Admin') }}</li>
				<li class="">{{ link_to_route('professor-profile', 'Professor') }}</li>
				<!--<li class="">{{ link_to_route('search', 'Search') }}</li>-->
			</ul>

			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
					<li class="pull-right">{{ link_to_route('logout', 'Logout') }}</li>
				@else 	
					<li class="pull-right">{{ link_to_route('login-page', 'Login') }}</li>
				@endif
			</ul>

		<!--</div>-->
		
	</div>
</nav>
<!--
<div class="row">
	<div class="col-xs-12">
		<div class="header" ng-show="isHeaderVisible()" ng-cloak>
			<ul class="nav nav-pills">
				<li class="">{{ link_to_route('home', 'Home') }}</li>
				<li class="">{{ link_to_route('admin-dashboard','Admin') }}</li>
				<li class="">{{ link_to_route('professor-profile', 'Professor') }}</li>
				<li class="">{{ link_to_route('search', 'Search') }}</li>
				@if(Auth::check())
					<li class="pull-right">{{ link_to_route('logout', 'Logout') }}</li>
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
-->