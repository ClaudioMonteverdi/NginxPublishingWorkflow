<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ApprovalRequirement extends Eloquent
{

	use SoftDeletingTrait;

	protected $fillable = [
		'revision_id',
		'approvable_id',
		'approvable_type'
	];

	/**
	 * Determines the relationship between Revision and ApprovalRequirement
	 *
	 * @access public
	 * @return void
	 */
	public function revision()
	{
		return $this->belongsTo('Revision');
	}

	/**
	 * Determines the relationship between Approvable and ApprovalRequirement
	 *
	 * @access public
	 * @return void
	 */
	public function approvable()
	{
		return $this->morphTo();
	}

	/**
	 * Determines the relationship between Role and ApprovalRequirement
	 *
	 * @access public
	 * @return void
	 */
	public function roles()
	{
		return $this->morphedByMany('Role', 'approvable', 'approval_requirements', 'approvable_id', 'approvable_type');
	}

	/**
	 * Determines the relationship between User and ApprovalRequirement
	 *
	 * @access public
	 * @return void
	 */
	public function users()
	{
		return $this->morphedByMany('User', 'approvable', 'approval_requirements', 'approvable_id', 'approvable_type');
	}

	/**
	 * Determines the relationship between Approval and ApprovalRequirement
	 *
	 * @access public
	 * @return void
	 */
	public function approval()
	{
		return $this->hasOne('Approval');
	}

}
