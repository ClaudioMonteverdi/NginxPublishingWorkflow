<div class="form-group">
		{{Form::label('name', 'Name', array('class' => 'col-sm-5 control-label')) }}
	<div class="col-sm-7">
		{{Form::text('name', isset($release->name) ? $release->name : null)}}
		{{ $errors->first('name', '<span class="error">:message</span>') }}
	</div>
</div>	
