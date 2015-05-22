<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class ExecuteScript extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'execute:script';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Executes an external .bash script.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		# Get the arguments
		$dir = $this->argument('dir');
		$script = $this->argument('script');

		# If the file exists, execute it, else return error.
		if( file_exists($dir . '/' . $script) ) {
			$code =	'cd ' . $dir . ' && screen bash -x ' . $script;
			
			$this->line('Bash code: ' . $code);
			
			exec($code, $output);
			
			$this->line('Output:');
			$this->line($output);
		}
		else {
			$this->line('That script does not exist.');
		}

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('dir', InputArgument::REQUIRED, 'Relative path to the directory the script is in.'),
			array('script', InputArgument::REQUIRED, 'Name of the script to execute.'),
		);
	}

}

