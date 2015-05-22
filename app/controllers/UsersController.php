<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = Role::all();
		return View::make('users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		Validator::extend('password', function($attribute, $value, $parameters)
		{
			//set the default number of passed validations
			$num = 0;
			if(preg_match('/[A-Z]/', $value))
			{
				$num++;
			}

			if(preg_match('/[a-z]/', $value))
			{
				$num++;
			}

			if(preg_match('/[0-9]/', $value))
			{
				$num++;
			}

			if(preg_match('/[^a-zA-Z0-9]+/', $value))
			{
				$num++;
			}

			if($num < 3)
			{
				return false; 
			}

			return true;

		});

		$rules = [
			'first_name'        => 'required',
			'last_name'         => 'required',
			'username'			=> 'required|unique:users',
			'email'             => 'required|email|unique:users',
			'password'          => 'required|min:6|password',
			'approval_password' => 'required|min:6|password|different:password',
			'role_id'           => 'required'
		];

		$messages = [
			'role_id.required' => 'You must select a role.',
			'password.password' => 'The password does not meet the requirements.'
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$user = new User(Input::all());
		$user->save();

		return Redirect::route('users.index');
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		$roles = Role::all();
		return View::make('users.show', compact('roles', 'user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);

		Validator::extend('password', function($attribute, $value, $parameters)
		{
			//set the default number of passed validations
			$num = 0;
			if(preg_match('/[A-Z]/', $value))
			{
				$num++;
			}

			if(preg_match('/[a-z]/', $value))
			{
				$num++;
			}

			if(preg_match('/[0-9]/', $value))
			{
				$num++;
			}

			if(preg_match('/[^a-zA-Z0-9]+/', $value))
			{
				$num++;
			}

			if($num < 3)
			{
				return false; 
			}

			return true;

		});

		$rules = [
			'first_name'        => 'required',
			'last_name'         => 'required',
			'username'			=> 'required',
			'email'             => 'required|email',
			'role_id'           => 'required',
			'password'          => 'min:6|password',
			'approval_password' => 'min:6|password|different:password',
		];

		$messages = [
			'role_id.required' => 'You must select a role.',
			'password.password' => 'The password does not meet the requirements.'
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$user->fill(Input::all());

		$user->save();

		return Redirect::route('users.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	}

}
