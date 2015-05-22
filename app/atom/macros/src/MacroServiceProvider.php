<?php namespace Atom\Macros;

use Illuminate\Html\HtmlServiceProvider;

class MacroServiceProvider extends HtmlServiceProvider
{
	public function register()
	{
		parent::register();

		require base_path() . '/app/atom/macros/src/macros.php';
	}
}
