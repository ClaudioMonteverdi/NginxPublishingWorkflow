<?php
Event::listen('revision.created', function($revision)
{
	$data = [
		'title' => 'New Revision Created',
		'revision_id' => $revision->id,
		'release_id' => $revision->release_id,
	];

	$emails = [];

	$email = $revision->user->email;

	//first send an email to the user that created this revision
	Mail::queue('emails.revisions.created', $data, function($message) use ($email, $data)
	{
		$message->to($email)->subject($data['title']);
	});

	$emails[] = $email;
	

	//when an event is created, we want to notify anyone selected as an approval requirement
	foreach($revision->approvalRequirements as $requirement)
	{

		if($requirement->approvable_type == 'User')
		{
			//if the type is a user, notify them directly
			$email = $requirement->approvable->email;	
		}

		if($requirement->approvable_type == 'Role')
		{
			//we want to email the primary user of this role
			$email = $requirement->approvable->primary->email;
		}


		//if the email does not exist in the emails list, we can send an email
		if(array_search($email, $emails) === false){
			Mail::queue('emails.revisions.created', $data, function($message) use ($email, $data)
			{
				$message->to($email)->subject($data['title']);
			});
		}

		//add the email to the list of emails so we don't sent multiple to the same user
		$emails[] = $email;

	}

});

Event::listen('approval.created', function($approval)
{
	//we want to listen for approval so that we can automatically set the revisions release to approved
	if($approval->revision->release->approvable())
	{
		$approval->revision->release->approve();
	}

});

# This is called when revisions are approved
Event::listen('release.approved', function($release)
{
	$data = [
		'title' => 'Release Approved',
		'release_id' => $release->id,
	];

	$emails = [];

	$email = $release->creator->email;

	//first send an email to the user that created this revision
	Mail::queue('emails.releases.approved', $data, function($message) use ($email, $data)
	{
		$message->to($email)->subject($data['title']);
	});

	$emails[] = $email;
});

Event::listen('release.created', function($release)
{
	$data = [
		'title' => 'New Release Created',
		'release_id' => $release->id,
	];

	$email = $release->creator->email;

	//first send an email to the user that created this revision
	Mail::queue('emails.releases.created', $data, function($message) use ($email, $data)
	{
		$message->to($email)->subject($data['title']);
	});

	Artisan::call('execute:script', array('dir' => '/data1/site', 'script' => 'snapshot-into-pending-review.bash'));

});

