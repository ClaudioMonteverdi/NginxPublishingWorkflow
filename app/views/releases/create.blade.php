@extends('layouts.master')
@section('title', 'Create New Release')
@section('content')
<div class="row row-header">
	<h1>Create New Release</h1>
</div>
{{ Form::open(array('route' => array('releases.store'), 'class' => 'form-horizontal release-create')) }}
@include('releases.form')
@include('elements.button', ['button' => 'Create'])
{{ Form::close() }}
@stop {{-- end of content section --}}
