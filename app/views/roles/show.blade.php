@extends('layouts.master')
@section('title', 'Edit Role')
@section('content')
<div class="row row-header">
	<h1>Edit Role</h1>
</div>
{{ Form::model($role, array('route' => ['roles.update', $role->id], 'class' => 'form-horizontal role-edit', 'method' => 'PUT')) }}
@include('roles.form')
@include('elements.button', ['button' => 'Edit'])
{{ Form::close() }}
@stop {{-- end of content section --}}
