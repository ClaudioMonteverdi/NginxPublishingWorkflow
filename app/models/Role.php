<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Role extends Eloquent
{

	use SoftDeletingTrait;

	protected $fillable = [
		'name',
		'primary_id',
	];

	/**
	 * Determines the relationship between a User and a Role
	 *
	 * @access public
	 * @return void
	 */
	public function users()
	{
		return $this->hasMany('User');
	}

	/**
	 * Determines the relationship between an ApprovalRequirement and a Role
	 *
	 * @access public
	 * @return void
	 */
	public function approvalRequirements()
	{
		return $this->morphToMany('ApprovalRequirement', 'approvable', 'approvalRequirements', 'approvable_id', 'approveable_type');  
	}

	/**
	 * Returns the formated name for Role
	 *
	 * @access public
	 * @return void
	 */
	public function name()
	{
		return $this->name;
	}
	
	/**
	 * Determines the relationship between the primary User and Role
	 *
	 * @access public
	 * @return void
	 */
	public function primary()
	{
		return $this->belongsTo('User', 'primary_id');
	}

	/**
	 * Returns the markup used in the approval widget
	 *
	 * @access public
	 * @return void
	 */
	public function approvalMarkup()
	{
		return $this->name() . ' (R)';
	}

	/**
	 * Returns a query with roles that are Assignable (Not Administrator)
	 *
	 * @param mixed $query
	 * @access public
	 * @return void
	 */
	public function scopeAssignable($query)
	{
		return $query->where('assignable', '!=', 0);
	}
}
