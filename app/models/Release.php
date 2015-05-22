<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Release extends \Eloquent {

	use SoftDeletingTrait;

	protected $fillable = [
		'name',
		'release_date',	
	];

	/**
	 * Determines the relationship between Revision and Release
	 *
	 * @access public
	 * @return void
	 */
	public function revisions()
	{
		return $this->hasMany('Revision');
	}

	/**
	 * Determines the relationship between the User which created this Release
	 *
	 * @access public
	 * @return void
	 */
	public function creator()
	{
		return $this->belongsTo('User', 'creator_id')->withTrashed();
	}
	
	/**
	 * Determines the relationship between the User which published this Release 
	 *
	 * @access public
	 * @return void
	 */
	public function publisher()
	{
		return $this->belongsTo('User', 'publisher_id')->withTrashed();
	}

	/**
	 * Returns a query of all releases which are considered published
	 *
	 * @param mixed $query
	 * @access public
	 * @return Query
	 */
	public function scopePublished($query)
	{
		return $query->whereStatus('Published');
	}

	/**
	 * Returns a query of all releases which are not published
	 *
	 * @param mixed $query
	 * @access public
	 * @return Query
	 */
	public function scopeNotPublished($query)
	{
		return $query->where('status' , '!=', 'Published');
	}

	/**
	 * Determines whether a release is approvable due to all of the revisions being approved
	 *
	 * @access public
	 * @return void
	 */
	public function approvable()
	{
		foreach($this->revisions as $revision)
		{
			if($revision->approved() === false)
			{
				return false;
			}
		}

		return true;

	}

	/**
	 * Determines if the Release is publishable by checking if the status is approved
	 *
	 * @access public
	 * @return void
	 */
	public function publishable()
	{
		if($this->status == 'Approved')
		{
			return true;
		}

		return false;

	}

	/**
	 * Approves the Release
	 *
	 * @access public
	 * @return void
	 */
	public function approve()
	{
		$this->status = 'Approved';
		$this->save();

		Event::fire('release.approved', $this);
	}

	/**
	 * Publishes the Release
	 *
	 * @access public
	 * @return void
	 */
	public function publish()
	{
		if(Auth::user()->isContentAdmin()){
			$this->status = 'Published';
			$this->release_date = date('Y-m-d H:i:s'); 
			$this->publisher_id = Auth::user()->id;
			$this->save();
		}
	}

	/**
	 * Determines if the Release is editable (not Published)
	 *
	 * @access public
	 * @return void
	 */
	public function editable()
	{
		if($this->status != 'Published')
		{
			return true;
		}

		return false;
	}
}
