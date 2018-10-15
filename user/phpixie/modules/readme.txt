
/*
 * This folder contains the core PHPixie modules.
 *
 * The modules are loaded automagically for you when you access them
 * via the pixie object.
 *
 * eg.
 */

class MyController extends \PHPixie\Controller {

	public function action_index() {
	
		// Access the orm module and create a new 'fairy'
		$this->pixie->orm->get('fairy');			// This will automagically load the 'orm' module

	}
}

/*
 * Yes, the way I separated the PHPixie add-ons into 'modules'
 * and 'plugins' wasn't an exact science - FTB.
 *
 */
