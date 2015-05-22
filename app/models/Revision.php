<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Revision extends Eloquent
{

	use SoftDeletingTrait;

	protected $fillable = [
		'name',
		'live_url',
		'approval_url',
		'user_id'
	];

	/**
	 * Determines the relationship between Approval and Revision
	 *
	 * @access public
	 * @return void
	 */
	public function approvals()
	{
		return $this->hasMany('Approval')->with('role', 'user');
	}

	/**
	 * Determines the relationship between User and Revision
	 *
	 * @access public
	 * @return void
	 */
	public function user()
	{
		return $this->belongsTo('User')->withTrashed();
	}	

	/**
	 * Determines the relationship between Release and Revision
	 *
	 * @access public
	 * @return void
	 */
	public function release()
	{
		return $this->belongsTo('Release');
	}

	/**
	 * Determine if a revision has met all of it's approval criteria
	 *
	 * @access public
	 * @return void
	 */
	public function approved()
	{

		//get a list of the approval requirements that have been satisfied
		$approvals = $this->approvals->lists('approval_requirement_id');

		//get a list of all of the approval requirements
		$approval_requirements = $this->approvalRequirements->lists('id');

		if(count(array_diff($approval_requirements, $approvals)) > 0)
		{
			return false;
		}

		return true;

	}

	/**
	 * Determine if a user has approved this Revision
	 *
	 * @param mixed $user_id
	 * @access public
	 * @return void
	 */
	public function userHasApproved($user_id = null)
	{
		$user = Auth::user();
		if(!is_null($user_id)){
			$user = User::find($user_id);
		}

		//determine if the currently authenticated user has approved this revision or not 
		return !empty($this->approvals()->where('user_id', $user->id)->get()->toArray());
	}

	/**
	 * Return the approval for this Revision from a specific User
	 *
	 * @param mixed $user_id
	 * @access public
	 * @return void
	 */
	public function userApproval($user_id = null)
	{
		$user = Auth::user();
		if(!is_null($user_id)){
			$user = User::find($user_id);
		}
		if(!$user) return false;

		return $this->approvals()->where('user_id', $user->id)->first();


	}

	/**
	 * Determine the relationship between ApprovalRequirement and Revision
	 *
	 * @access public
	 * @return void
	 */
	public function approvalRequirements()
	{
		return $this->hasMany('ApprovalRequirement')->with('approvable', 'approval');
	}

	/**
	 * Determines if a specified user needs to approve the current revision 
	 *
	 * @param mixed $user_id
	 * @access public
	 * @return void
	 */
	public function userNeedsToApprove($user_id = null)
	{
		if($this->userApprovalRequirement($user_id) !== false && !$this->userHasApproved($user_id))
		{
			return true;
		}

		return false;
	}

	/**
	 * Determine which approval requirement this user fulfills for this revision (if any)
	 *
	 * @param mixed $user_id
	 * @access public
	 * @return integer, false
	 */
	public function userApprovalRequirement($user_id = null)
	{
		$user = Auth::user();
		if(!is_null($user_id)){
			$user = User::find($user_id);
		}

		if(!$user) return false;

		$approval_requirements = $this->approvalRequirements;
		//we want to be the most specific, so we will first see if there is a requirement
		//for this specific user to approve this revision
		
		//create a variable to store a possible approval requirement 
		$approval_requirement_id = false;
		//loop over all the requiements
		foreach($approval_requirements as $requirement)
		{
			//if the type is user, and the id matches this user
			if($requirement->approvable_type == 'User' && $requirement->approvable_id == $user->id)
			{
				$approval_requirement_id = $requirement->id;
				//break out of the for loop, since we've found exactly what we are looking for
				break;
			}

			//if the type is role, and it matches this user's role
			if($requirement->approvable_type == 'Role' && $requirement->approvable_id == $user->role->id)
			{
				$approval_requirement_id = $requirement->id;
			}

		}

		return $approval_requirement_id;

	}

	/**
	 * Determines if the current Revision is editable (Release is Pending)
	 *
	 * @access public
	 * @return void
	 */
	public function editable()
	{
		if($this->release->status == 'Pending')
		{
			return true;
		}

		return false;
	}
}
