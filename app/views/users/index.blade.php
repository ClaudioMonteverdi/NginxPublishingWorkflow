@extends('layouts.master')
@section('title', 'Users')
@section('content')
<div class="row row-header">
	<div class="col-sm-8">
		<h1>Users List</h1>
	</div>
	<div class="col-sm-4 page-actions">
		<a href="{{URL::route('users.create')}}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> New User</a>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
			<th>Primary</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td>{{$user->id}}</td>
				<td>{{HTML::linkRoute('users.show', $user->name(), $user->id)}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->role->name}}</td>
				<td>@if($user->hasPrimary())<i class="glyphicon glyphicon-ok"></i>@endif</td>
				<td>{{Form::formActions('users', 'user_id', $user->id, false)}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop {{-- end of content section --}}
