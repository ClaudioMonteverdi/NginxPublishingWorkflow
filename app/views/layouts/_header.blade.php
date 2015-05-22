<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
		{{ HTML::style('css/main.css') }}
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/chosen.min.css') }}
		{{ HTML::style('css/bootstrap-theme.min.css') }}
		@yield('head')
	</head>
	<body class="{{str_replace('.', '-', Route::getCurrentRoute()->getName())}}">
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			{{HTML::linkRoute('home', '', null,array('class' => 'brand navbar-brand')) }}
			</div>
			<div class="navbar-collapse collapse navbar-right">
			  <ul class="nav navbar-nav">
				@if(Auth::check())
					@if(Auth::user()->isAdmin())
						@include('nav._admin')
					@endif
						@include('nav._user')
				@else
					@include('nav._guest')
				@endif
			  </ul>
			</div><!--/.nav-collapse -->
		  </div> <!--/.container-->
		</div><!--/.navbar -->
		<div class="container">
			<div class="inner">
