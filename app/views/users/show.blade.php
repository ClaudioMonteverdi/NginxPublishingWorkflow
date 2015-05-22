@extends('layouts.master')
@section('title', 'Edit User')
@section('content')
<div class="row row-header">
	<h1>Edit User</h1>
</div>
{{ Form::model($user, array('route' => ['users.update', $user->id], 'class' => 'form-horizontal user-edit', 'method' => 'PUT')) }}
@include('users.form')
@include('elements.button', ['button' => 'Edit'])
{{ Form::close() }}
@stop {{-- end of content section --}}
