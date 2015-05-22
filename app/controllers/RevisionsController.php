<?php

class RevisionsController extends \BaseController {

	public function __construct()
	{
		//$this->beforeFilter('auth.admin.content', ['except' => 'index']);
	}

	/**
	 * Display a listing of the resource.
	 * GET /revisions
	 *
	 * @return Response
	 */
	public function index($release_id)
	{
		$release = Release::find($release_id);
		$revisions = Revision::where('release_id', $release_id)->with('approvals')->get();
		return View::make('revisions.index', compact('revisions', 'release'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /revisions/create
	 *
	 * @return Response
	 */
	public function create($release_id)
	{
		$release = Release::find($release_id);
		$users = User::all();
		$roles = Role::assignable()->with('primary')->get();
		return View::make('revisions.create', compact('users', 'roles', 'release'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /revisions
	 *
	 * @return Response
	 */
	public function store($release_id)
	{
		$release = Release::find($release_id);
		$rules = [
			'name'                  => 'required',
			'live_url'              => 'required|url',
			'approval_url'          => 'required|url',
			'approval_requirements' => 'required',
		];

		$messages = [
			'approval_requirements.required' => "You must select at least one approval requirement.",
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$revision = new Revision(Input::all());
		$revision->user_id = Auth::user()->id;
		$revision->release_id = $release_id;

		$revision->save();

		//attach the approval requirements
		foreach(Input::get('approval_requirements') as $requirement)
		{
			//split the requirements into the type and id
			$requirement = explode('.', $requirement);
			$name = ucwords($requirement[0]);
			$data = [
				'revision_id' => $revision->id,
				'approvable_type' => $name,
				'approvable_id' => $requirement[1],
			];
			$revision->approvalRequirements()->create($data);
		}

		//when we save a new revision, we want to make sure we change the release back to pending
		$revision->release->status ='Pending';
		$revision->release->save();

		Event::fire('revision.created', [$revision]);
		return Redirect::route('releases.revisions.index', $release->id);
	}

	/**
	 * Display the specified resource.
	 * GET /revisions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($release_id, $id)
	{
		$revision = Revision::find($id);
		return View::make('revisions.show', compact('revision'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /revisions/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($release_id, $id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /revisions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($release_id, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /revisions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($release_id, $id)
	{
		$revision = Revision::find($id);

		if($revision)
		{
			//get the release
			$release = $revision->release;

			//delete the revision
			$revision->delete();

			//once we've deleted a revision, we need to check if the release should be approved
			if($release->approvable() && count($release->revisions) > 0)
			{
				//the release now meets the approval critera, approve it
				$release->approve();
			}
		}

		return Redirect::route('releases.revisions.index', $release_id);
	}

}
