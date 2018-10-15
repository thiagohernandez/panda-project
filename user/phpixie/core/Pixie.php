<?php

namespace PHPixie;

 class Pixie {
	
	// This is a prefix for your app.
	//
	// You can use these prefixes to install multiple apps side-by-side
	// on your server.
	//
	// nb. It's *not* a path name, it's just an arbitrary prefix,
	// it can be anything you want it to be.
	//
	// The idea is that your .htaccess file will look for this prefix
	// and redirect requests to the folder where your app is stored.
	//
	// eg. '/app1/...' can redirect to an application in folder 'application1'
	//     '/xyz/...' can redirect to an application in a different folder
	//
	// Prefixes are usually only one level deep and never have a trailing slash.
	//
	public $basepath = '';		// eg. '/myapp'

	// This adds the basepath to a URL, with optional subfolder
	//
	// eg. add_base_folder('logo.png','/img/') will return "$basepath/img/logo.png"
	private $offsite = array(
		'http://',
		'https://'
	);
	public function add_base_folder($url, $f='') {
		$isOffsite = false;
		foreach ($this->offsite as $o) {
			// Don't do anything if the URL starts with any of the prefixes in '$offsite'
			if (substr($url,0,strlen($o))==$o) {
				$isOffsite = true;
				break;
			}
		}
		if (!$isOffsite) {
			$url = $this->basepath.$f.$url;
		}
		return $url;
	}

 	/**
	 * Root directory of the application (ie. the app's folder on disk)
	 * @var array
	 */
	public $root_dir;

  /**
	 * This defines the available modules (and the files where they're defined)
	 */
	public $instance_classes = array(
		// These are 'core'
		'config'  => '\PHPixie\Config',
		'cookie' 	=> '\PHPixie\Cookie',
		'debug'   => '\PHPixie\Debug',
		'router'  => '\PHPixie\Router',
		'session' => '\PHPixie\Session',
		// These are 'optional' (but you probably want them!)
		'db' 			=> '\PHPixie\DB',
		'orm'			=> '\PHPixie\ORM',
		'auth' 		=> '\PHPixie\Auth',
		'migrate' => '\PHPixie\Migrate'
	);
	
 	/**
	 * Instanced classes
	 * @var array
	 */
	private $instances = array();
	

	/**
	 * Gets a property by name. Returns defined class and module instances
	 *
	 * @param string $name Property name
	 * @return mixed Instance of defined class or module
	 */
	public function __get($name) {
		if (isset($this->instances[$name])) {
			return $this->instances[$name];
		}

		// Automagically load the PHPixie classes/modules when needed
		if (isset($this->instance_classes[$name])) {
			return $this->instances[$name] = new $this->instance_classes[$name]($this);
		}

		throw new \Exception("Pixie: Addon module '{$name}' not found");
	}

	/**
	 * Constructs a controller by class name
	 *
	 * @param string $class Controller class
	 * @return \PHPixie\Controller
	 * @throw  \PHPixie\Exception\PageNotFound If the controller class is not found
	 */
	public function controller($class) {
		if (!class_exists($class)) {
			throw new \PHPixie\Exception\PageNotFound("Class {$class} doesn't exist");
		}
		return new $class($this);
	}
	
	/**
	 * Constructs a request
	 *
	 * @param  Route  $route  Route for this request
	 * @param  string $method HTTP method for the request (e.g. GET, POST)
	 * @param  array  $post   Array of POST data
	 * @param  array  $get    Array of GET data
	 * @param  array  $server Array of SERVER data
	 * @param  array  $cookie Array of COOKIE data
	 * @return \PHPixie\Request
	 */
	public function request($route, $method = "GET", $post = array(), $get = array(), $param=array(), $server = array(), $cookie = array()) {
		return new \PHPixie\Request($this, $route, $method, $post, $get, $param, $server, $cookie);
	}
	
	/**
	 * Constructs a response
	 *
	 * @return \PHPixie\Response
	 */
	public function response() {
		return new \PHPixie\Response($this);
	}
	
	/**
	 * Constructs a view
	 *
	 * @param string   $name The name of the template to use
	 * @return \PHPixie\View
	 */
	public function view($name) {
		return new \PHPixie\View($this, $this->view_helper(), $name);
	}
	
	/**
	 * Constructs a view helper
	 *
	 * @return \PHPixie\View\Helper
	 */
	public function view_helper() {
		return new \PHPixie\View\Helper($this);
	}
	
	/**
	 * Retrieve value from array by key, with default value support.
	 *
	 * @param array  $array   Input array
	 * @param string $key     Key to retrieve from the array
	 * @param mixed  $default Default value to return if the key is not found
	 * @return mixed An array value if it was found or default value if it is not
	 */
	public function arr($array, $key, $default = null)
	{
		if (isset($array[$key])) {
			return $array[$key];
		}
		return $default;
	}

	/**
	 * Creates a Request representing current HTTP request.
	 *
	 * @return \PHPixie\Request
	 */
	public function http_request()
	{
		$uri = rawurldecode($_SERVER['REQUEST_URI']);
		$uri = preg_replace("#^/(?:index\.php/?)?#i", '/', $uri);
		$url_parts = parse_url($uri);
		$route_data = $this->router->match($url_parts['path'], $_SERVER['REQUEST_METHOD']);
		return $this->request($route_data['route'], $_SERVER['REQUEST_METHOD'], $_POST, $_GET, $route_data['params'], $_SERVER, $_COOKIE);
	}
	
	/**
	 * Processes HTTP request, executes it and sends back the response.
	 *
	 * @return void
	 */
	public function handle_http_request() {
		try {
			$request = $this->http_request();
			$response = $request->execute();
			if ($response) {
				$response->send_headers()->send_body();
			}
		}
		catch (\Exception $e) {
			$this->handle_exception($e);
		}
	}
	
	/**
	 * Exception handler. By default displays the error page.
	 * If you want your exceptions to be handled in a specific way
	 * you should override this method.
	 *
	 * @param \Exception $exception Exception to handle
	 * @return void
	 */
	public function handle_exception($exception) {
		$this->debug->render_exception_page($exception);
	}
	

	/**
	 * Constructs a route
	 *
	 * @param string $name Name of the route
	 * @param mixed $rule Rule for this route
	 * @param array $defaults Default parameters for the route
	 * @param mixed $methods Methods to restrict this route to.
	 *                       Either a single method or an array of them.
	 * @return \PHPixie\Route
	 */
	public function route($name, $rule, $defaults, $methods = null) {
		return new \PHPixie\Route('/', $name, $this->basepath.$rule, $defaults, $methods);
	}

	/**
	 * Bootstrap the application
	 */
	public function bootstrap($root_dir) {
		$this->root_dir = rtrim($root_dir, '/') . '/';
		
		$this->before_bootstrap();

		$this->debug->init();

		$routes = $this->config->get('routes');
		foreach($routes as $name => $rule) {
			$this->router->add($this->route($name, $rule[0], $rule[1], $this->arr($rule, 2, null)));
		}
		
		$this->after_bootstrap();
		
		return $this;
	}
	
	/**
	 * Callbacks for before/after bootstrap
	 */
	protected function before_bootstrap() {}
	protected function after_bootstrap() {}
}
