@extends('layouts.master')
@section('title', 'Create New Role')
@section('content')
<div class="row row-header">
	<h1>Create New Role</h1>
</div>
{{ Form::open(array('route' => array('roles.store'), 'class' => 'form-horizontal role-create')) }}
@include('roles.form')
@include('elements.button', ['button' => 'Create'])
{{ Form::close() }}
@stop {{-- end of content section --}}
