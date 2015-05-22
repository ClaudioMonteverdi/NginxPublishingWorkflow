<?php

class ApprovalsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /approvals
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /approvals/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /approvals
	 *
	 * @return Response
	 */
	public function store()
	{
		//first check that the password supplied matches, otherwise we don't need to do any more logic
		$password = Input::get('approval_password');
		if(!Hash::check($password, Auth::user()->approval_password))
		{
			return Redirect::back()->with('flash_error','Your approval password was incorrect.')->withInput();
		}
		/* when someone approves somthing, we need to determine which requirement it fullfilled.
		 * the first step is to get the revision's approval requirements
		 */
		$revision = Revision::find(Input::get('revision_id'));

		if($revision->userHasApproved()){
			return Redirect::back()->with('flash_error','You have already approved this revision.')->withinput();
		}

		if(!$revision)
		{
			return redirect::back()->with('flash_error','There was an error. please contact support with error code: 896')->withinput();
		}
		$approval_requirement_id = $revision->userApprovalRequirement(Auth::user()->id);

		if(!$approval_requirement_id)
		{
			return Redirect::back()->with('flash_error','You do not fullfil any requirements for this revision.')->withinput();
		}

		$approval = new Approval();
		$approval->revision_id = Input::get('revision_id');
		$approval->user_id = Auth::user()->id;
		$approval->role_id = Auth::user()->role->id;
		$approval->approval_requirement_id = $approval_requirement_id;
		$approval->save();
		Event::fire('approval.created', $approval);

		return Redirect::route('releases.revisions.index', $revision->release->id);
	}

	/**
	 * Display the specified resource.
	 * GET /approvals/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /approvals/{id}/edit
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
	 * PUT /approvals/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /approvals/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
