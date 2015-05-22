@extends('layouts.master')
@section('title', 'Create New User')
@section('content')
<div class="row row-header">
	<h1>Create New User</h1>
</div>
{{ Form::open(array('route' => array('users.store'), 'class' => 'form-horizontal user-create')) }}
@include('users.form')
@include('elements.button', ['button' => 'Create'])
{{ Form::close() }}
@stop {{-- end of content section --}}
