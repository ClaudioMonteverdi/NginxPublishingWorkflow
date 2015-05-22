<?php

class RolesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /roles
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = Role::all();
		return View::make('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /roles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$users = User::all();
		return View::make('roles.create', compact('users'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /roles
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = [
			'name' => 'required|unique:roles',
			'primary_id' => 'required'
		];

		$messages = [
			'primary_id.required' => 'You must select a user.'
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$role = new Role(Input::all());
	
		$role->save();

		return Redirect::route('roles.index');
	}

	/**
	 * Display the specified resource.
	 * GET /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$users = User::all();
		$role = Role::find($id);
		return View::make('roles.show', compact('role', 'users'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /roles/{id}/edit
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
	 * PUT /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role = Role::find($id);

		$rules = [
			'name' => 'required',
			'primary_id' => 'required'
		];

		$messages = [
			'primary_id.required' => 'You must select a user.'
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}
		
		$role->fill(Input::all());

		$role->save();

		return Redirect::route('roles.index');

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	}

}
