@if($revision->editable())
	<a class="pull-left btn btn-success btn-xs" href="{{URL::route('releases.revisions.show', [$release->id, $revision->id]) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
	@if(Auth::user()->isContentAdmin())
		{{Form::open(array("route" => array('releases.revisions.destroy', $release->id, $revision->id ), "method" => "DELETE", "class" => "pull-left delete-form"))}}
		<button type="submit" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</button>
		{{Form::close()}}
	@endif
@else
	<span class="no-data">no actions available</span>
@endif
