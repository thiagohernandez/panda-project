
/*
 * This folder contains the original plugins for PHPixie.
 *
 * Plugins are loaded automagically for you when you access them
 * from a controller plugin.
 *
 * You can also put plugins in "app\Controller\Plugins"
 *
 */

 // How to access a plugin from a controller
class MyController extends \PHPixie\Controller {

	public function action_index() {
	
		// It's this easy!
		$this->email->do_something();			// This will automagically load the 'email' plugin from the 'plugins' folder

	}
}

/*
 * If a plugin needs access to the global pixie object then you can
 * inherit from class '\PHPixie\Plugin'.
 *
 *eg.
 */

class MyPlugin extends \PHPixie\Plugin {

	// Your action
	public function action_foo() {

		// Access the pixie object
		$pixie = $this->pixie;
		
		// You can also access the controller object if you need it...
		$controller = $this->controller;
	}
}

