<?php

namespace PHPixie;

/**
 * Manages passing variables to templates and rendering them
 * @package Core
 */
class View
{
	/**
	 * Pixie Dependancy Container
	 * @var \PHPixie\Pixie
	 */
	public $pixie;
	
	/**
	 * View helper
	 * @var \PHPixie\View\Helper
	 */
	public $helper;
	
	/**
	 * Full path to template file
	 * @var string
	 */
	protected $path;

	/**
	 * The name of the view.
	 * @var string
	 */
	public $name;

	/**
	 * Stores all the variables passed to the view
	 * @var array
	 */
	protected $_data = array();

	/**
	 * Constructs the view
	 *
	 * @param \PHPixie\Pixie $pixie Pixie dependency container
	 * @param \PHPixie\View\Helper View Helper
	 * @param string   $name The name of the template to use
	 */
	public function __construct($pixie, $helper, $name)
	{
		$this->pixie = $pixie;
		$this->helper = $helper;
		$this->set_template($name);
	}
	
	/**
	 * Sets the template to use for rendering
	 *
	 * @param string   $name The name of the template to use
	 * @throws \Exception If specified template is not found
	 */
	private function make_file_name($path,$name) {
		return $this->pixie->root_dir.$path.$name.'.php';
	}
	public function set_template($name) {
		$this->name = $name;
		
		$file = $this->make_file_name('app/View/',$name);
		if (!file_exists($file)) {
			$file = $this->make_file_name('phpixie/core/View/',$name);
			if (!file_exists($file)) {
				throw new \Exception("View {$name} not found.");
			}
		}
		$this->path = $file;
	}

	/**
	 * Manages storing the data passed to the view as properties
	 *
	 * @param string $key Property name
	 * @param string $val Property value
	 * @return void
	 */
	public function __set($key, $val)
	{
		$this->_data[$key] = $val;
	}

	/**
	 * Manages checking whether a dynamic property has been defined or not
	 *
	 * @param string $key Property name
	 * @return boolean
	 */
	public function __isset($key)
	{
		return array_key_exists($key, $this->_data);
	}

	/**
	 * Manages accessing passed data as properties
	 *
	 * @param string   $key Property name
	 * @return mixed	Property value
	 * @throws \Exception If the property is not found
	 */
	public function __get($key)
	{
		if (array_key_exists($key, $this->_data)) {
			return $this->_data[$key];
		}
		throw new \Exception("Value {$key} not set for view {$this->name}");
	}

	/*
	 * Get a named string from my view helper
	 */
	public function text($key) {
		return $this->helper->text($key);
	}

	/**
	 * Renders the template, all dynamically set properties
	 * will be available inside the view file as variables.
	 * Aliases form a View Helper will be added automatically.
	 * Example:
	 * <code>
	 * $view = $this->pixie->view('frontpage');
	 * $view->title = "Page title";
	 * echo $view->render();
	 * </code>
	 *
	 * @return string Rendered template
	 * @see \PHPixie\View\Helper
	 */
	public function render() {
		extract($this->helper->get_aliases());
		extract($this->_data);
		ob_start();
		include($this->path);
		return ob_get_clean();
	}
	
	/**
	 * Insert a sub-element into a page with local variables
	 */
	private function do_insert($data, $params) {
		// Get extension functions from the helper
		extract($this->helper->get_aliases());
		// This is in local context so we need to grab the parent's variables
		extract($data);
		// And we add the local variables from '$params'
		extract($params);
		include($this->path);
	}
	public function insert($element, $params=array()) {
		$temp = new View($this->pixie, $this->helper, dirname($this->name).DIRECTORY_SEPARATOR.$element);
		$temp->do_insert($this->_data,$params);
	}
}
