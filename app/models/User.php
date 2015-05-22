<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token', 'approval_password');

	protected $dates = ['deleted_at'];

	protected $fillable = [
		'email',
		'username',
		'password',
		'approval_password',
		'first_name',
		'last_name',
		'role_id',
	];

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
	 * Determines the relationship between Release and User
	 *
	 * @access public
	 * @return void
	 */
	public function release()
	{
		return $this->hasMany('Release');
	}
	
	/**
	 * Determines the relationship between Approval and User
	 *
	 * @access public
	 * @return void
	 */
	public function approvals()
	{
		return $this->hasMany('Approval');
	}

	/**
	 * Returns if the user is an administrator
	 *
	 * @access public
	 * @return boolean
	 */
	public function isAdmin()
	{
		if($this->role->name == 'Administrator')
		{
			return true;
		}

		return false;
	}

	/**
	 * Returns if a user is a primary on a role 
	 *
	 * @access public
	 * @return boolean
	 */
	public function hasPrimary()
	{
		if(Role::where('primary_id', $this->id)->first())
		{
			return true;
		}

		return false;
	}

	/**
	 * Returns if a user is a content admin
	 *
	 * @access public
	 * @return void
	 */
	public function isContentAdmin()
	{
		if($this->role->name == 'Administrator' || $this->role->name == 'Publisher')
		{
			return true;
		}

		return false;
	}

	/**
	 * Automatically hashes the password on save
	 *
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	public function setPasswordAttribute($value){
		if(!empty($value)){	
			$this->attributes['password'] = Hash::make($value);
		}
	}

	/**
	 * Automatically hashes the approval password on save
	 *
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	public function setApprovalPasswordAttribute($value){
		if(!empty($value)){	
			$this->attributes['approval_password'] = Hash::make($value);
		}
	}

	/**
	 * Returns this models formatted name
	 *
	 * @access public
	 * @return void
	 */
	public function name()
	{
		return $this->first_name . " " . $this->last_name;
	}

	/**
	 * Returns this model's markup for the approval widget view
	 *
	 * @access public
	 * @return void
	 */
	public function approvalMarkup()
	{
		return $this->name() . ' (U)';
	}

	/**
	 * Defines the relationship between ApprovalRequirement and User
	 *
	 * @access public
	 * @return void
	 */
	public function approvalRequirements()
	{
		return $this->morphToMany('ApprovalRequirement', 'approvable', 'approvalRequirements', 'approvable_id', 'approveable_type');  
	}

	/**
	 * Defines the relationship between Revision and user
	 *
	 * @access public
	 * @return void
	 */
	public function revisions()
	{
		return $this->hasMany('Revision');
	}
}
