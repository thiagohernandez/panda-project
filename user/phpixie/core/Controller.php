<?php

namespace PHPixie;

/**
 * Base Controller class. Controllers contain the  logic of your website,
 * each action representing a reply to a particular request, e.g. a single page.
 * @package Core
 */
class Controller
{
	
	/**
	 * Pixie Dependancy Container
	 * @var \PHPixie\Pixie
	 */
	public $pixie;
	
	/**
	 * Request for this controller. Holds all input data.
	 * @var \PHPixie\Request
	 */
	public $request;

	/**
	 * Response for this controller. It will be updated with headers and
	 * response body during controller execution
	 * @var \PHPixie\Response
	 */
	public $response;

	/**
	 * My View object
	 * @var \PHPixie\View
	 */
	public $view = null;

	/**
	 * If set to False stops controller execution
	 * @var boolean
	 */
	public $execute = true;

	/**
	 * This method is called before the action.
	 * You can override it if you need to,
	 * it doesn't do anything by default.
	 *
	 * @return void
	 */
	public function before()
	{

	}

	/**
	 * This method is called after the action.
	 * By default it renders the view file (if you set one)
	 *
	 * @return void
	 */
	public function after() {
		if ($this->view) {
			$this->response->body = $this->view->render();
		}
	}

	/**
	 * Creates new Controller
	 *
	 */
	public function __construct($pixie)
	{
		$this->pixie = $pixie;
		$this->response = $pixie->response();
	}

	/**
	 * Shortcut for redirecting the user.
	 * Use like this:
	 * <code>
	 *     return $this->redirect($url);
	 * </code>
	 *
	 * @param string $url URL to redirect to.
	 * @return void
	 */
	public function redirect($url) {
		$this->response->redirect($url);
		$this->execute = false;
	}
	
	/**
	 * Runs the appropriate action.
	 * It will execute the before() method before the action
	 * and after() method after the action finishes.
	 *
	 * @param string    $action Name of the action to execute.
	 * @return void
	 * @throws \PHPixie\Exception\PageNotFound If the specified action doesn't exist
	 */
	public function run($action) {
		$action = 'action_'.$action;
		
		$this->execute = true;
		$this->before();
		
		// FTB: The method isn't obligatory (you only need a view)
		if ($this->execute) {
			$this->$action();
		}
		if ($this->execute) {
			$this->after();
		}
	}
	
	/**
	 * Added by FTB
	 *
	 * This makes it easy to send AJAX replies
	 *
	 * Just do "$this->ajax_reply($var)" in your controller
	 */
	public function ajax_reply($response) {
		if (!is_string($response)) {
			$response = json_encode($response);
		}
		$this->execute = false;
		$this->response->body = $response;
	}

	/**
	 * Added by FTB
	 *
	 * This makes controllers user-extensible in a similar way to the main Pixie object
	 *
	 * You can define an array of plugin classes which will be loaded automagically
	 */
	
	// An array of ('name' => 'class_name') pairs for each plugin
	protected $plugins = array();
	
	// The plugin classes that have been loaded (cache)
	private $instances = array();
	
	public function __get($name) {
		if (isset($this->instances[$name])) {
			return $this->instances[$name];	// We already have this one
		}
		
		// FTB: Return the matching $pixie module (if it exists)
		if (isset($this->pixie->instance_classes[$name])) {
			return $this->pixie->$name;
		}

		// Look for plugins in the 'PHPixie\plugins' folder
		$Name = ucfirst($name);
		$plugin = '\\PHPixie\\'.$Name;
		//$this->pixie->debug->log("looking for ".$plugin);
		if (!class_exists($plugin)) {
			// Next look in the 'app\Plugins' folder
			$plugin = '\\App\\'.$Name;
			//$this->pixie->debug->log("Not found, looking for ".$plugin);
			if (!class_exists($plugin)) {
				// Look in the list of plugins for this app
				if (isset($this->plugins[$name])) {
					// Create a new one
					$plugin = $this->plugins[$name];
				}
			}
		}
		if (class_exists($plugin)) {
			//$this->pixie->debug->log("Found! ".$plugin);
			//$this->pixie->debug->log("making a ".$plugin);
			$instance = new $plugin($this->pixie, $this);
			$this->instances[$name] = $instance;
			if ($instance instanceof \PHPixie\Plugin) {
				$instance->on_load();
			}
			return $instance;
		}

		throw new \Exception('Controller plugin "'.$name.'" not found!');
	}

}
