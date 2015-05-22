<?php

class ReleasesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /releases
	 *
	 * @return Response
	 */
	public function index()
	{
		$releases = Release::with('revisions', 'revisions.user')->get();
		return View::make('releases.index', compact('releases'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /releases/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('releases.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /releases
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = [
			'name' => 'required'
		];

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$release = new Release(Input::all());
		$release->creator_id = Auth::user()->id;

		$release->save();

		Event::fire('release.created', $release);

		return Redirect::route('releases.index');
	}

	/**
	 * Display the specified resource.
	 * GET /releases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$release = Release::find($id);
		return View::make('releases.show', compact('release'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /releases/{id}/edit
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
	 * PUT /releases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$release = Release::find($id);

		$rules = [
			'name' => 'required'
		];

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$release->fill(Input::all());

		$release->save();

		return Redirect::route('releases.index');


	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /releases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$release = Release::find($id);

		if($release)
		{
			$release->delete();
		}

		return Redirect::route('releases.index');
	}

	public function revisions($release_id)
	{
		$release = Release::find($release_id);
		$revisions = Revision::where('release_id', $release_id)->get();

		return View::make('releases.revisions', compact('revisions', 'release'));
		
	}

	public function publish($release_id)
	{
		//first check that the password supplied matches, otherwise we don't need to do any more logic
		$password = Input::get('approval_password');
		if(!Hash::check($password, Auth::user()->approval_password))
		{
			return Redirect::back()->with('flash_error','Your publish password was incorrect.')->withInput();
		}

		$release = Release::find($release_id);

		$release->publish();

		return Redirect::route('releases.index');
		
		Artisan::call('execute:script', array('dir' => '/data1/site', 'script' => 'snapshot-into-live.bash'));
	}

}

