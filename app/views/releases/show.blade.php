@extends('layouts.master')
@section('title', 'Edit Release')
@section('content')
<div class="row row-header">
	<h1>Edit Release</h1>
</div>
{{ Form::model($release, array('route' => ['releases.update', $release->id], 'class' => 'form-horizontal role-edit', 'method' => 'PUT')) }}
@include('releases.form')
@include('elements.button', ['button' => 'Edit'])
{{ Form::close() }}
@stop {{-- end of content section --}}
