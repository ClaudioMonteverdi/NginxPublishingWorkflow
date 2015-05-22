@if($release->editable() && Auth::user()->isContentAdmin())
	{{Form::formActions('releases', 'release_id', $release->id)}}
@else
	<span class="no-data">no actions available</span>
@endif
