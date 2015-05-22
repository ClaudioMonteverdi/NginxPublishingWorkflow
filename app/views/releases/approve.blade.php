@if($release->publishable()) 
	<button type="submit" data-toggle="modal" data-target="#publish_modal" data- class="btn btn-success pull-right"><i class="glyphicon glyphicon-ok"></i> Publish</button>
@endif
@if($release->status == 'Pending')
	<a href="{{URL::route('releases.revisions.create', $release->id)}}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> New Revision</a>
@endif

<div id="publish_modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Publish Release</h4>
      </div>
      <div class="modal-body">
		@if(Session::has('flash_error'))
			<div class="session-flash error">{{ Session::get('flash_error')}}</div>
		@endif
			{{Form::open(array("route" => array('releases.publish', $release->id,), "method" => "POST"))}}
			<div class="form-group">
					{{Form::label('aproval_password', 'Publish Password', array('class' => 'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{Form::password('approval_password')}}
					{{ $errors->first('approval_password', '<span class="error">:message</span>') }}
				</div>
			</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		{{Form::submit('Publish', array('class' => 'btn btn-success')) }}
		{{Form::close()}}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
