@section('selectors')
<div class="search-options btn-toolbar" role="toolbar">
	<div class="row" id="search_options">
		<div class="col-xs-12 col-md-4 text-center">
			<span class="text-muted">Project</span>
			<div class="clearfix"></div>
			<div class="btn-group btn-group-sm">
				<button type="button" class="btn btn-default active" id="proj_title">Project Title</button>
				<button type="button" class="btn btn-default" id="proj_tags">Project Tags</button>
			</div>
		</div>

		<div class="col-xs-12 col-md-4 text-center">
			<span class="text-muted">Faculty</span>
			<div class="clearfix"></div>
			<div class="btn-group btn-group-sm">
				<button type="button" class="btn btn-default" id="fac_name">Faculty Name</button>
				<button type="button" class="btn btn-default" id="fac_code">Faculty Code</button>
			</div>
		</div>

		<div class="col-xs-12 col-md-4 text-center">
			<span class="text-muted">Subject</span>
			<div class="clearfix"></div>
			<div class="btn-group btn-group-sm">
				<button type="button" class="btn btn-default" id="sub_name">Subject Name</button>
				<button type="button" class="btn btn-default" id="sub_code">Subject Code</button>
			</div>
		</div>

	</div>
</div>
@stop
@section('selector-scripts')
	<script>
		function setActive(elem) {
			buttons = [
				$('#proj_title'),
				$('#proj_tags'),
				$('#fac_name'),
				$('#fac_code'),
				$('#sub_name'),
				$('#sub_code')
			];
			for(var i=0;i<buttons.length; i++) {
				buttons[i].removeClass('active');
			}
			elem.addClass('active');
		}

		var searchUrl='{{ route("search-project-title") }}';
		$('#proj_title').click(function() {
			searchUrl = '{{ route("search-project-title") }}';
			setActive($('#proj_title'));
		});
		$('#proj_tags').click(function() {
			searchUrl = '{{ route("search-project-tags") }}';
			setActive($('#proj_tags'));
		});
		$('#fac_name').click(function() {
			searchUrl = '{{ route("search-faculty-name") }}';
			setActive($('#fac_name'));
		});
		$('#fac_code').click(function() {
			searchUrl = '{{ route("search-faculty-code") }}';
			setActive($('#fac_code'));
		});
		$('#sub_name').click(function() {
			searchUrl = '{{ route("search-subject-name") }}';
			setActive($('#sub_name'));
		});
		$('#sub_code').click(function() {
			searchUrl = '{{ route("search-subject-code") }}';
			setActive($('#sub_code'));
		});
	</script>
@stop