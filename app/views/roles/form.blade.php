<div class="form-group">
		{{Form::label('name', 'Name', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::text('name', isset($role->name) ? $role->name : null)}}
		{{ $errors->first('name', '<span class="error">:message</span>') }}
	</div>
</div>	
<div class="form-group">
	<div class="form-messages">
		{{Form::label('primary_id', 'Primary User', array('class' => 'col-sm-5 control-label')) }}
	</div>
	<div class="col-sm-7">
		<select name="primary_id">
				<option value=''>-Select-</option>
			@foreach($users as $user)
				@if(isset($role->primary_id) && $role->primary_id = $user->id)
					<option selected="selected" value="{{$user->id}}">{{$user->name()}}</option>
				@else
					<option value="{{$user->id}}">{{$user->name()}}</option>
				@endif
			@endforeach
		</select>
		{{ $errors->first('primary_id', '<span class="error">:message</span>') }}
	</div>
</div>	
