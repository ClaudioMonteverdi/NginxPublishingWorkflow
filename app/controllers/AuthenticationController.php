<?php
class AuthenticationController extends Controller
{
	public function loginform(){
		if(Auth::check()){
			return Redirect::route('home');
		}

		return View::make('account.login');
	}

	public function login(){
		$field = filter_var(Input::get('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		if (Auth::attempt(array($field => Input::get('username'), 'password' => Input::get('password')), false)) {
			return Redirect::route('home');
		}

		return Redirect::route('account.form')->with('flash_error','Your username and password combination is incorrect')->withInput();

	}

	public function logout(){
		Auth::logout();
		return Redirect::route('account.login');
	}

	public function home(){
		//save flash messages for the home
		Session::reflash();

		if(!Auth::check())
		{
			return Redirect::route('account.login');
		}

		return Redirect::route('releases.index');
	}
}	
