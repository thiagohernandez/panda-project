<?php

namespace App\View;

/**
 * View helper class.
 * An instance of this class is passed automatically
 * to every View.
 *
 * You can extend it to make your own methods available in view templates.
 *
 * @package Core
 */
class Helper {

	/**
	 * Pixie Dependancy Container
	 * @var \PHPixie\Pixie
	*/
	protected $pixie;
	
	/**
	 * Constructs the view helper
	 * @param \PHPixie\Pixie $pixie Pixie dependency container
	 */
	public function __construct($pixie) {
		$this->pixie = $pixie;
	}
	
	/**
	 * List of aliases to create for methods
	 * @var array
	 */
	protected $aliases = array(
		'_' => 'output',
		'_txt' => 'text',
		'_css' => 'css',
		'_script' => 'script',
		'_inline_script' => 'inline_script',
		'_img' => 'img',
		'_asset' => 'asset',
		'_link' => 'link',
		'_text' => 'text',
		'_date' => 'date',
		'_number' => 'number',
		'_money' => 'money'
	);
	
	/**
	 * Gets the array of aliases to helper methods
	 * 
	 * @return array Associative array of aliases mapped to their methods
	 */
	public function get_aliases() {
		$aliases = array();
		foreach($this->aliases as $alias => $method)
			$aliases[$alias] = array($this, $method);
		return $aliases;
	}
	
	/**
	 * Escapes string to safely display HTML entities
	 * like < > & without breaking layout and prevent XSS attacks.
	 *
	 * @param string $str String to escape
	 * @return string Escaped string.
	 */
	public function escape($str) {
		return htmlentities($str);
	}
	
	/**
	 * Escapes and prints a string.
	 *
	 * @param string $str String to escape
	 * @see \PHPixie\View\Helper::escape
	 */
	public function output($str) {
		echo $this->escape($str);
	}

/* These were added by FTB */
	public function add_base_folder($url, $f='') {
		return $this->pixie->add_base_folder($url,$f);
	}
	/**
	 * Insert a javascript file in the output
	 */
	public function script($s) {
		$url = $this->add_base_folder($s,'/js/');
		return '<script src="'.$url.'"></script>'.PHP_EOL;
	}
	public function inline_script($s) {
		readfile($this->pixie->root_dir.'web/js/'.$s);
	}

	/**
	 * Insert a css file in the output
	 */
	public function css($c) {
		$url = $this->add_base_folder($c,'/css/');
		return '<link rel="stylesheet" type="text/css" href="'.$url.'">'.PHP_EOL;
	}

	/**
	 * Link to an image file
	 */
	public function img($i) {
		return $this->add_base_folder($i,'/img/');
	}

	/**
	 * Link to somthing in folder '/web/assets' (use for videos/sounds/etc)
	 */
	public function asset($i) {
		return $this->add_base_folder($i,'/assets/');
	}

	/**
	 * Link to another page
	 */
	public function link($i) {
		return $this->add_base_folder($i);
	}

	/**
	 * Languages
	 */
	private $_lang = null;
	private function load_language($name) {
		$n = '/App/View/Language/'.$this->pixie->language_prefix.$name;
		$n = strtr($n, '/', '\\');
		$this->_lang = new $n;
	}
	public function lang() {
		if (!$this->_lang) {
			$this->load_language('English');
		}
		if (!$this->_lang) {
			$this->load_language('Spanish');
		}
		return $this->_lang;
	}
	public function text($t) {
		return $this->lang()->$t;
	}

	/**
	 * Locally formatted information
	 */
	public function date($d) {
		$t = strtotime($d);		// Assume $d came from a database, we need to convert it to UTF
		return date('d-M-Y', $t);
	}
	public function number($n, $d=2) {
		$dp = $this->lang()->dpoint;
		$ts = $this->lang()->tseparator;
		return number_format($n,$d,$dp,$ts);
	}
	public function money($a) {
		return $this->number($a,2).'&nbsp;&euro;';
	}
	
	// Decode locally formatted information
	public function parse_number($n) {
		$dp = $this->lang()->dpoint;
		$ts = $this->lang()->tseparator;
		$n = str_replace($ts, '', $n);		// Remove thousands separators
		$n = str_replace($dp, '.', $n);		// Replace decimal point with '.'
		return (float)$n;
	}
}
