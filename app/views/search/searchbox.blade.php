@section('searchbox')
<div class="form-group">
	<div id="remote">
		<input class="typeahead form-control" type="text" id="search_input" placeholder="Enter search term"/>
	</div>
</div>
@stop

@section('header-scripts')
	<script src="{{asset('js/typeahead.min.js')}}"></script>
@append

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
		},
	  // source: results.ttAdapter()
	});

	$('#search_input').bind('typeahead:selected', function(obj, datum, name) {      
        console.log(datum.id);
        var baseUrl = "{{ URL::to('/') }}"
        window.location =baseUrl+'/show-professor/'+datum.id;
	});
</script>
@stop