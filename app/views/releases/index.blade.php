@extends('layouts.master')
@section('title', 'Releases')
@section('content')
<div class="row row-header">
	<div class="col-sm-8">
		<h1>Releases List</h1>
	</div>
	<div class="col-sm-4 page-actions">
		@if(Auth::user()->isContentAdmin())
			@if(count(Release::notPublished()->get()) == 0)
				<a href="{{URL::route('releases.create')}}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> New Release</a>
			@endif
		@endif
	</div>
</div>
@if(count(Release::notPublished()->get()) > 0)
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach ($releases as $release)
				@if($release->status != 'Published')
					<tr>
						<td>{{$release->id}}</td>
						<td>{{HTML::linkRoute('releases.revisions.index', $release->name, $release->id)}}</td>
						<td>@include('releases.actions')</td>
					</tr>
				@endif
			@endforeach
		</tbody>
	</table>
</div>
@else
	<span class="no-data">There are no current releases</span>
@endif
@if(count(Release::published()->get()) > 0)
<h2>Published Releases</h2>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Published By</th>
			<th>Publish Date</th>
		</thead>
		<tbody>
			@foreach ($releases as $release)
				@if($release->status == 'Published')
					<tr>
						<td>{{$release->id}}</td>
						<td>{{HTML::linkRoute('releases.revisions.index', $release->name, $release->id)}}</td>
						<td>{{$release->creator->name()}}</td>
						<td>{{clean_datetime($release->release_date)}}</td>
					</tr>
				@endif
			@endforeach
		</tbody>
	</table>
</div>
@endif
@stop {{-- end of content section --}}
