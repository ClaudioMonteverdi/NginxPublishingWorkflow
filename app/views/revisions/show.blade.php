@extends('layouts.master')
@section('title', 'Revisions')
@section('content')
<div class="row row-header">
	<div class="col-sm-6">
		<h1>Revision - {{$revision->name}}</h1>
	</div>
	<div class="col-sm-6 page-actions">
		<div class="row">
			@include('approvals.widget', compact('revision'))</h1>
		</div>
		<div class="row">
			<span class="pull-right">If you need to contact the author of this revision, you can email {{HTML::mailto($revision->user->email)}}.</span>
		</div>
	</div>
</div>
<div class="row row-header">
	<div class="col-sm-4">
		<span class="site-label pull-left">Live Site</span>
	</div>
	<div class="col-sm-4">
		@include('approval_requirements.widget', compact('revision'))
	</div>
	<div class="col-sm-4">
		<span class="site-label pull-right">Approval Site</span>
	</div>
</div>
<div class="row" style="display: none;">
	<div class="col-xs-6 compare-control">
		<input id="compare-url-live" type="text" class="form-control" value="{{$revision->live_url}}">
	</div>
	<div class="col-xs-6 compare-control">
		<input id="compare-url-approval" type="text" class="form-control" value="{{$revision->approval_url}}">
	</div>
</div>
<div class="row"  style="display: none;">
	<div class="col-xs-6 frame-control left">
		<input id="left-url" type="text" class="form-control" value="">
	</div>
	<div class="col-xs-6 frame-control right">
		<input id="right-url" type="text" class="form-control" value="">
	</div>
</div>
<div class="row">
	<div class="col-xs-6">
		<iframe class="compare-frame left" src="about:blank" frameBorder="0" ></iframe>
	</div>

	<div class="col-xs-6">
		<iframe class="compare-frame right" src="about:blank" frameBorder="0" ></iframe>
	</div>
</div>
<div class="row">
</div>
@include('approvals.create', compact('revision'))
@stop {{-- end of content section --}}
@section('footer')
@if(Session::has('flash_error'))
<script>
	/* jslint browser:true */
	/* global $:true */
	$(document).ready(function(){
		'use strict';
		$('#approval_modal').modal('toggle');
	});
</script>
@endif
<script>
//set the iframe containers to the right height
$('iframe').height($(window).height() - $('iframe').offset().top - 15);
</script>
@stop
