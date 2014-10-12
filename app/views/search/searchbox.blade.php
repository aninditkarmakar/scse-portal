@section('searchbox')
<div class="form-group">
	<div id="remote">
		<input class="typeahead form-control" type="text" placeholder="Enter search term"/>
	</div>
</div>
@stop

@section('header-scripts')
	<script src="{{asset('js/typeahead.min.js')}}"></script>
@stop

@section('searchbox-scripts')
<script>
	var results = new Bloodhound({
		datumTokenizer: function (d) {
            return Bloodhound.tokenizers.whitespace(d.name);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
		remote: {
			url: ''+searchUrl,
			rateLimitWait: 2000
		}
	});

	var resultId;

	results.initialize();
	 
	$('#remote .typeahead').typeahead({
		highlight: true,
		hint: true
	}, 
	{
		name: 'search-results',
		displayKey: 'name',
		source: function (query, process) {
			resultId = 0;
			
			return $.get(''+searchUrl, { q: query }, function (data) {
			    return process(data.data);
			});
		}
	  // source: results.ttAdapter()
	});
</script>
@stop