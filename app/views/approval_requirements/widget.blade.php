<div class="approval_requirements">
	@foreach($revision->approval_requirements as $role => $approval_requirement)
	@if(empty($approval_requirement->approval))
		<span class="label label-default label-not-approved">{{$approval_requirement->approvable->approvalMarkup()}}</span>
	@else
	<span title="Approved by {{$approval_requirement->approval->user->name()}} on {{clean_datetime($approval_requirement->approval->created_at)}}" class="label label-success"><i class="glyphicon glyphicon-ok"></i> {{$approval_requirement->approvable->approvalMarkup()}}</span>
	@endif
	@endforeach
</div>
