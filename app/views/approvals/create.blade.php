<div id="approval_modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Approve Revision</h4>
      </div>
		<div class="alert alert-info" role="alert">
			If you need to contact the author of this revision, you can email {{HTML::mailto($revision->user->email)}}.
		</div>
      <div class="modal-body">
		@if(Session::has('flash_error'))
			<div class="session-flash error">{{ Session::get('flash_error')}}</div>
		@endif
		{{Form::open(['route' => 'approvals.store', 'class' => 'form-horizontal'])}}
			{{Form::hidden('revision_id', $revision->id)}}
			<div class="form-group">
					{{Form::label('aproval_password', 'Approval Password', array('class' => 'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{Form::password('approval_password')}}
					{{ $errors->first('approval_password', '<span class="error">:message</span>') }}
				</div>
			</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		{{Form::submit('Approve', array('class' => 'btn btn-success')) }}
		{{Form::close()}}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
