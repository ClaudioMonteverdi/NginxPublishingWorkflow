@extends('layouts.master')
@section('title', 'Login');
@section('content')
<h1>Login</h1>
{{ Form::open(array('route' => 'account.login', 'class' => 'form-horizontal login-form')) }}
@if(Session::has('flash_error'))
<div class="session-flash error">{{ Session::get('flash_error')}}</div>
@endif
	<div class="form-group">
		{{Form::label('username', 'Username', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::text('username')}}
			{{ $errors->first('username', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="form-group">
		{{Form::label('password', 'Password', array('class' => 'col-sm-5 control-label')) }}
		<div class="col-sm-7">
			{{Form::password('password')}}
			{{ $errors->first('password', '<span class="error">:message</span>') }}
		</div>
	</div>	
	<div class="actions">
		{{Form::submit('LOGIN', array('class' => 'btn btn-primary btn-lg')) }}
	</div>	
	{{ Form::close() }}
@stop {{-- end of content section --}}
@section('footer')
