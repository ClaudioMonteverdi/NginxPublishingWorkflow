<?php
Form::macro('inlineEdit', function($route, $id_name, $id, $name = 'Edit')
{
	$url = URL::route($route, [$id_name => $id]);
	return '<a class="pull-left btn btn-success btn-xs" href="' . $url . '"><i class="glyphicon glyphicon-edit"></i> '.$name.'</a>';
});

Form::macro('inlineDelete', function($route, $id, $name = 'Delete')
{
	$html  = Form::open(array("route" => array($route, $id ), "method" => "DELETE", "class" => "pull-left delete-form"));
	$html .=     '<button type="submit" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> '.$name.'</button>';
	$html .= Form::close();
	 
	return $html;

});

Form::macro('formActions', function($route, $id_name, $id, $allow_delete = true, $edit_name = 'Edit', $delete_name = 'Delete' )
{
	$html  = Form::inlineEdit($route . '.show', $id_name, $id, $edit_name);
	if($allow_delete)
	{
		$html  .= Form::inlineDelete($route . '.destroy', $id, $delete_name);
	}

	return $html;
});
