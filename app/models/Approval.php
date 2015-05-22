<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Approval extends Eloquent
{

	use SoftDeletingTrait;

	protected $fillable = [
		'user_id',
		'role_id',
		'revision_id',
	];

	/**
	 * Determines the relationship between User and Approval 
	 *
	 * @access public
	 * @return void
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

	/**
	 * Determines the relationship between Role and User
	 *
	 * @access public
	 * @return void
	 */
	public function role()
	{
		return $this->belongsTo('Role');
	}

	/**
	 * Determines the relationship between Revision and Approval
	 *
	 * @access public
	 * @return void
	 */
	public function revision()
	{
		return $this->belongsTo('Revision');
	}

	/**
	 * Determines the relationship between ApprovalRequirement and Approval
	 *
	 * @access public
	 * @return void
	 */
	public function approval_requirement()
	{
		return $this->belongsTo('ApprovalRequirement');
	}
}
