@if($revision->userNeedsToApprove())
	<button class="btn btn-success pull-right" data-toggle="modal" data-target="#approval_modal"><i class="glyphicon glyphicon-ok"></i> Approve</button>
@else
	@if($revision->userApproval())
		<span class="label label-lg label-success pull-right">You approved this revision on {{clean_datetime($revision->userApproval()->created_at)}}</span>
	@else
		<span class="label label-lg label-default pull-right">You are not required to approve this revision</span>
	@endif

@endif
