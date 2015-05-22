@extends('layouts.master')
@section('title', 'Revisions')
@section('content')
<div class="row row-header">
	@if($release->status == 'Published')
		<div class="alert alert-info">
			This release was published on {{clean_datetime($release->release_date)}} by {{$release->publisher->name()}}.
		</div>
	@endif
	<div class="col-sm-8">
		<h1>{{$release->name}} - Revisions </h1>
	</div>
	@if(Auth::user()->isContentAdmin())
		<div class="col-sm-4 page-actions">
			@include('releases.approve')
		</div>
	@endif
</div>
@if(count($revisions) > 0)
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Live URL</th>
			<th>Approval URL</th>
			<th>Approvals</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach ($revisions as $revision)
			<tr>
				<td>{{$revision->id}}</td>
				<td>{{HTML::linkRoute('releases.revisions.show', $revision->name,[$release->id, $revision->id])}}</td>
				<td><a target = "_blank" href="{{$revision->live_url}}">{{$revision->live_url}}</a></td>
				<td><a target = "_blank" href="{{$revision->approval_url}}">{{$revision->approval_url}}</a></td>
				<td>@include('approval_requirements.widget', compact('revision'))</td>
				<td>@include('revisions.actions')</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
	<div class="no-data">There are no revisions to display.</div>
@endif
@stop {{-- end of content section --}}
@section('footer')
@if(Session::has('flash_error'))
<script>
	$(document).ready(function(){
		$('#publish_modal').modal('toggle');
	});
</script>
@endif
@stop
