<div class="form-group">
		{{Form::label('first_name', 'First Name', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::text('first_name', isset($user->first_name) ? $user->first_name : null)}}
		{{ $errors->first('first_name', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
		{{Form::label('last_name', 'Last Name', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::text('last_name', isset($user->last_name) ? $user->last_name : null)}}
		{{ $errors->first('last_name', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('username', 'Username', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		{{Form::text('username', isset($user->username) ? $user->username : null)}}
		{{ $errors->first('username', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('email', 'Email', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		{{Form::text('email', isset($user->email) ? $user->email : null)}}
		{{ $errors->first('email', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('password', 'Password', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		{{Form::password('password')}}
		{{ $errors->first('password', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('approval_password', 'Approval Password', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		{{Form::password('approval_password')}}
		{{ $errors->first('approval_password', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('role_id', 'Role', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		<select name="role_id">
			<option value=''>-Select-</option>
			@foreach($roles as $role)
				@if(isset($user->role->id) && $user->role->id == $role->id)
					<option selected="selected" value="{{$role->id}}">{{$role->name}}</option>
				@else
					<option value="{{$role->id}}">{{$role->name}}</option>
				@endif
			@endforeach
		</select>
		{{ $errors->first('role_id', '<span class="error">:message</span>') }}
	</div>
</div>	
