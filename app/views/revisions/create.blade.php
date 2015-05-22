@extends('layouts.master')
@section('title', 'Create New Revision')
@section('content')
<div class="row row-header">
	<h1>Create New Revision</h1>
</div>
{{ Form::open(array('route' => array('releases.revisions.store', $release->id), 'class' => 'form-horizontal revision-create')) }}
<div class="form-group">
		{{Form::label('name', 'Name', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::text('name')}}
		{{ $errors->first('name', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('live_url', 'Live URL', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		{{Form::text('live_url')}}
		{{ $errors->first('live_url', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('approval_url', 'Approval URL', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		{{Form::text('approval_url')}}
		{{ $errors->first('approval_url', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('approval_requirements', 'Approval Requirements', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		<select name="approval_requirements[]" id="approval_requirements" multiple>
			<optgroup label="Roles">
				@foreach($roles as $role)
				<option value="role.{{$role->id}}">{{$role->name}} ({{$role->primary->name()}})</option>
				@endforeach
			</optgroup>
			<optgroup label="Users">
				@foreach($users as $user)
					<option value="user.{{$user->id}}">{{$user->name()}}</option>
				@endforeach
			</optgroup>
		</select>
		{{ $errors->first('approval_requirements', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="actions">
	{{form::submit('CREATE', array('class' => 'btn btn-success btn-lg')) }}
</div>	
{{ Form::close() }}
@stop {{-- end of content section --}}
@section('footer')
<script>
$('#approval_requirements').chosen();
</script>
@stop
