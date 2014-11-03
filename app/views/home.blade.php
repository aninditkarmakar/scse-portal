@extends('layouts.master')

@section('header')
	@include('layouts.header')
@append

@section('body')
<div class="row body">
	<div class="col-md-3 col-events text-center">Events</div>
	<div class="col-md-6 col-content">
		
		<!--<div class="row">-->
			<div class="col-xs-12">
				<div class="text-center"><h2>Search</h2></div>
				<div class="clearfix"></div>
				<form role="form">
					<div class="form-group">
						@include('search.selectors')
						@yield('selectors')
						<div class="clearfix"></div>
						<hr/>
						@include('search.searchbox')
						@yield('searchbox')
					</div>
				</form>
				<hr>
			</div>
		<!--</div>-->

		<div class="row">
			<div class="col-xs-12">
				<div class="text-center"><h4>List by specialization</h4></div>
				
				<form role="form">
					<select multiple="multiple" name="field_research_interests_tid_1[]" id="edit-field-research-interests-tid-1" size="9" class="form-control"><option value="4722">Active Learning</option><option value="4842">Adaptive Systems and Interfaces</option><option value="5237">Algorithms and Data Structures</option><option value="4749">Animation</option><option value="5202">Applications</option><option value="5238">Artificial Intelligence</option><option value="4877">Assistive Technologies</option><option value="5108">Autonomous Navigation</option><option value="5243">Big Data/Data Mining</option><option value="4797">BioInformatics</option><option value="5240">Biology/Biochemistry</option><option value="5287">Cloud Computing</option><option value="4806">Compilers</option><option value="4732">Complexity</option><option value="5285">Computation, Organizations and Society</option><option value="4756">Computational Biology</option><option value="5278">Computational Epidemiology</option><option value="4763">Computational Geometry</option><option value="4775">Computational Mathematics</option><option value="5279">Computational Virology</option><option value="4750">Computer Graphics</option><option value="4753">Computer Music</option><option value="5245">Computer Systems</option><option value="5275">Computer Vision</option><option value="5244">Computer/Computer Science Education</option><option value="5242">Control Systems</option><option value="4733">Cryptography</option><option value="5117">Cyber-Physical Systems</option><option value="5671">Data Analytics</option><option value="4752">Data Visualization</option><option value="5246">Database Systems</option><option value="4810">Dependable and Embedded Systems</option><option value="4876">Design</option><option value="5291">Digital Forensics</option><option value="4844">Digital Libraries</option><option value="5286">Distributed Systems</option><option value="5260">Diversity and Outreach</option><option value="4767">eCommerce</option><option value="4896">Enabling Technologies</option><option value="5054">Entertainment</option><option value="5248">Field Robotics/Hazardous Environments</option><option value="5249">Formal Methods/Verification</option><option value="4768">Game Theory</option><option value="5681">Genomics</option><option value="4873">Haptics</option><option value="5289">Health Technologies</option><option value="5661">Human Language Technology</option><option value="4882">Human Perception</option><option value="5250">Human-Computer Interaction</option><option value="4725">Human-Robot Interaction (HRI)</option><option value="4975">Humanoid Robotics</option><option value="5280">ICT for Development (IC4D)</option><option value="5251">Image and Video Processing/Understanding/Recognition</option><option value="4723">Information Management</option><option value="4914">Information Search and Retrieval</option><option value="4737">Innovation and Entrepreneurship</option><option value="5208">interdisciplinary curricula in the area of drama and interactive multimedia</option><option value="4760">Knowledge Representation</option><option value="5152">Language Understanding</option><option value="5252">Learning/Learning Science/Learning Technologies</option><option value="4865">Logic</option><option value="4740">Machine Learning</option><option value="4765">Machine Translation</option><option value="4939">Manipulation</option><option value="5254">Manufacturing/Factory/Warehouse Robotics</option><option value="5255">Mathematics</option><option value="4942">Mechatronics</option><option value="4871">Medical Robotics</option><option value="4825">Mobile and Ubiquitous Computing</option><option value="5256">Mobile Robotics/Locomotion</option><option value="4959">Modeling and Simulation</option><option value="5257">Multi-Agent Systems</option><option value="4982">Multimedia</option><option value="4764">Natural Language Processing</option><option value="5641">Natural Language Semantics</option><option value="4748">Network Analysis</option><option value="5258">Networks and Distributed Computing</option><option value="5259">Neural Networks and Computation</option><option value="4925">Neuroscience</option><option value="4829">New Computing Paradigms</option><option value="4807">Operating Systems</option><option value="4726">Optimization</option><option value="4741">Parallel Computing</option><option value="4835">Pattern Recognition</option><option value="5282">Pervasive Computing</option><option value="4997">Planning and Scheduling</option><option value="4847">Privacy</option><option value="5269">Probability/Statistics</option><option value="5272">Programming Languages</option><option value="4883">Psychology</option><option value="5263">Quality of Life Technology</option><option value="5264">Question Answering</option><option value="4823">Queueing Theory</option><option value="5288">Rapid Prototyping Technologies</option><option value="4840">Realtime Systems</option><option value="4894">Robotics</option><option value="5084">Scientific Computing</option><option value="5276">Security</option><option value="5283">Semantic Web</option><option value="5265">Sensors/Perception</option><option value="5270">Shape Sensing/Recognition</option><option value="5267">Social Computing and Networks</option><option value="5651">Social Media Processing</option><option value="4853">Software Engineering</option><option value="5268">Software Systems and Architecture</option><option value="4960">Space Robotics</option><option value="5281">Speech and Language Technologies for Development</option><option value="4773">Speech Understanding and Systems</option><option value="5284">Supply Chain Management</option><option value="4881">Sustainability</option><option value="5271">Systems Engineering and Architecture</option><option value="5027">Technology Policy</option><option value="4963">Teleoperation</option><option value="4795">Text Analysis</option><option value="5273">Theory of  Computing</option><option value="5290">Toolkits and Systems</option><option value="5274">User Modeling</option></select>
				</form>
			</div>
		</div>

	</div>
	<div class="col-md-3 col-news text-center">News</div>
</div>
<!--<div class="container-fluid">
	<div class="jumbotron">
		<h1> Welcome to the SCSE Portal!</h1>
		<div class="row">
			<div class="col-md-4 col-xs-12">
				{{ link_to_route('admin-dashboard', 'Admin',null, array('class'=>'btn btn-primary')) }}
				
			</div>

			<div class="col-md-4 col-xs-12">
				{{ link_to_route('professor-profile', 'Professor', null, array('class'=>'btn btn-default')) }}
			</div>

			<div class="col-md-4 col-xs-12">
				{{ link_to_route('search', 'Search', null, array('class'=>'btn btn-warning')) }}
			</div> 
		</div>
	</div>	
</div>-->
@stop

@section ('scripts')
	@yield('selector-scripts')
	@yield('searchbox-scripts')
@append