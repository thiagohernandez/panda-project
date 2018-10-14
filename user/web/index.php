<?php
namespace PHPixie;

// The root folder of the App
$pixie_root = dirname(__DIR__);

// Files are included in the global namespace (to avoid clashes with local variables)
function pixieIncludeFile($file) {
	include($file);
}

// FTB's all-new, lightweight classloader for PHPixie
// This replaces the 'composer' classloader
class PixieLoader {
	
	// Where to look for classes
	private $paths = array(

		// PHPixie classes
		array( 'PHPixie',	array(
			'/phpixie/core/',
			'/phpixie/modules/',
			'/phpixie/plugins/'
		)),

		// Application-supplied classes
		array( 'App', array(
			'/app/',
			'/app/Controller/',
			'/app/Controller/Plugins/'
		))
	);

	// A list of known classes (so we don't reload the same files)
	private $cache = array();

	public function loadClass($class) {

		// Look in the cache
		if (!isset($this->cache[$class])) {
			// Assume File not found...
			$this->cache[$class] = false;

			// Separate the class name into package/class
			$logicalName = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';
			$pos = strpos($logicalName, DIRECTORY_SEPARATOR);
			$package_name = substr($logicalName, 0, $pos);
			$class_name = substr($logicalName, $pos+1);

			global $pixie_root;
			//echo "<br>Looking for: $class in $pixie_root<br>";
			foreach ($this->paths as $path) {
				if ($path[0] === $package_name) {
					foreach ($path[1] as $p) {
						$file = $pixie_root.$p.$class_name;
						//echo 'File: '.$file.'<br>';
						if (file_exists($file)) {
							//echo 'Found: '.$file.'<br>';
							pixieIncludeFile($file);
							$this->cache[$class] = true;
							return true;		// Found it!
						}
					}
				}
			}
		}
		//if (!$this->cache[$class]){echo$class;die;}
		return $this->cache[$class];
	}
}
// Register a PixieLoader with PHP
spl_autoload_register(array(new PixieLoader, 'loadClass'), true, true);

// Bootstrap the application
(new \App\Pixie)->bootstrap($pixie_root)->handle_http_request();
