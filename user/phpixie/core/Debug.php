<?php

namespace PHPixie;

/**
 * Handles error reporting and debugging.
 * @package Core
 */
class Debug
{

	/**
	 * Pixie Dependancy Container
	 * @var \PHPixie\Pixie
	 */
	protected $pixie;
	
	/**
	 * An array of logged items
	 * @var array
	 */
	public $logged = array();
	
	/**
	 * An array of logged items from SQL functions
	 * @var array
	 */
	public $sql_logged = array();

	/**
	 * Flag that determines if the errors are displayed
	 * @var boolean
	 */
	public $display_errors = true;
	
	/**
	 * Constructs a debugger
	 *
	 * @param \PHPixie\Pixie $pixie Pixie dependency container
	 */
	public function __construct($pixie) {
		$this->pixie = $pixie;
	}
	
	/**
	 * Displays the error page. If you set $display_errors to false
	 * only a small error message will be displayed.
	 *
	 * @param \Exception $exception Exception to display
	 * @return void
	 */
	public function render_exception_page($exception)
	{
		if (ob_get_length() > 0) {
			ob_end_clean();
		}

		$status = '503 Service Temporarily Unavailable';
		
		if ($exception instanceof \PHPixie\Exception\PageNotFound)
			$status = '404 Not Found';
			
		//header($_SERVER["SERVER_PROTOCOL"].' '.$status);
		//header("Status: {$status}");

		if (!$this->display_errors) {
			echo $status;
		}else{
			$view = $this->pixie->view('debug');
			$view->exception = $exception;
			$view->log = $this->logged;
			echo $view->render();
		}
		
	}

	/**
	 * Converts PHP Errors to Exceptions
	 *
	 * @param string        $errno   Error number
	 * @param string        $errstr  Error message
	 * @param string        $errfile File in which the error occurred
	 * @param string        $errline Line at which the error occurred
	 * @return void
	 * @throws \ErrorException Throws converted exception to be immediately caught
	 */
	public function error_handler($errno, $errstr, $errfile, $errline)
	{
		throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
	}

	/**
	 * Initializes the error handler
	 *
	 * @return void
	 */
	public function init()
	{
		set_error_handler(array($this, 'error_handler'), E_ALL);
	}

	/**
	 * Adds an item to the log.
	 *
	 * @param mixed $val Item to be logged
	 * @return void
	 */
	public function log($val)
	{
		array_unshift($this->logged, $val);		// Debug log is backwards... :-S
	}

	/**
	 * Adds an item to the log from inside SQL functions.
	 *
	 * @param mixed $val Item to be logged
	 * @return void
	 */
	private $_sql_prefix = '';
	public function sql_prefix($p) {
		$this->_sql_prefix = '<b>['.$p.']</b>&nbsp;&nbsp;&nbsp;';
	}
	public function sql_clear_prefix() {
		$this->_sql_prefix = '';
	}
	public function sql($val) {
		// ...SQL logs make a lot more sense if you read them forwards
		$this->sql_logged[] = $this->_sql_prefix.$val;
	}

	// Tidy up an entry for display
	public function format($val) {
		if (is_string($val)) {
			return $val;
		}
		else {
			return '<pre>'.var_export($val,true).'</pre>';
		}
	}
	
	private function find_data($val) {
		if ($val instanceof \PHPixie\ORM\Model) {
			$val = $val->as_array();
		}
		return $val;
	}
	public function pretty($val) {
		echo '<pre>'.json_encode($this->find_data($val),JSON_PRETTY_PRINT|JSON_PARTIAL_OUTPUT_ON_ERROR).'</pre>'.PHP_EOL;
	}
	
	public $echoToScreen = false;
	public $maxAge = 3;
	public function log_to_file($val) {
		$root = $this->pixie->root_dir;
		$fn = "$root/debug.txt";
		if (!file_exists($fn) || (filemtime($fn) < (time()-$this->maxAge))) {
			clearstatcache(true,$fn);
			$myfile = fopen($fn, "w");
			fwrite($myfile, 'PHPixie log started on '.date('l h:i:s').PHP_EOL);
		}
		else {
			$myfile = fopen($fn, "a+");
		}
		if ($myfile) {
			$val = $this->find_data($val);
			if (is_array($val)) {
				$val = json_encode($val,JSON_PRETTY_PRINT);
			}
			$val .= PHP_EOL;
			fwrite($myfile, $val);
			fclose($myfile);
		}
		if ($this->echoToScreen) {
			echo $val;
		}
	}
}
