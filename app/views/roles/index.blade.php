@extends('layouts.master')
@section('title', 'Roles')
@section('content')
<div class="row row-header">
	<div class="col-sm-8">
		<h1>Roles List</h1>
	</div>
	<div class="col-sm-4 page-actions">
		<a href="{{URL::route('roles.create')}}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> New Role</a>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Primary User</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach ($roles as $role)
			<tr>
				<td>{{$role->id}}</td>
				<td>{{HTML::linkRoute('roles.show', $role->name, $role->id)}}</td>
				<td>{{HTML::linkRoute('users.show', $role->primary->name(), $role->primary->id)}}</td>
				<td>{{Form::formActions('roles', 'role_id', $role->id, false)}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop {{-- end of content section --}}
