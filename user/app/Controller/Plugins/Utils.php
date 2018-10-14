<?php

// Random utility functions for the App
namespace App;
class FakeUser {
	public function idd() {
		return 136;
	}
	public $id = 0;
	public $email = 'fake@panda.com';
	public $level_id = 0;
	public $country_id = 7;
	public $continent = 1;
	public $accountType = 1;
};

class Utils extends \PHPixie\Plugin {

	public function get_user() {
		$u = $this->pixie->auth->user();
		if ($u) {
			$u = $this->pixie->db->query('select')->table('users')->where('id',$u->id())->execute()->as_array();
			if (count($u)>0) {
				//echo'<pre>';var_dump($u[0]);die;
				return (object)$u[0];
			}
		}
		return new \App\FakeUser;
	}

	public function dump($var, $eol=true) {
		echo '<pre>';
		echo json_encode($var,JSON_PRETTY_PRINT).PHP_EOL;
		echo '</pre>';
	}

/*
 * Load a config file/database table and swizzle it so it can be accessed by index
 */
	public function swizzle($table_name, $id='id') {
		$result = array();
		// Look for a config file
		$data = $this->pixie->config->get($table_name);
		if (!empty($data)) {
			foreach ($data as $d) {
				$result[$d[$id]] = (object)$d;
			}
		}
		// If not found, look in the database
		if (empty($result)) {
			$data = $this->pixie->db->query('select')->table($table_name)->execute()->as_array();
			foreach ($data as $d) {
				$result[$d->$id] = $d;
			}
		}
		return $result;
	}
 // Swizzle a table and add it to the view
	public function swizzle_to_view($table_name, $id='id') {
		$view = $this->controller->view;
		$view->$table_name = $this->swizzle($table_name,$id);
	}

	// Disable all output buffering (it can cause "out of memory" for large transmissions)
	private $output_is_disabled = false;
	public function disable_output_buffering() {
		if (!$this->output_is_disabled) {
			@ini_set("zlib.output_compression","0");
			@ini_set("output_buffering","off");
			@ini_set('implicit_flush', 1);
			@ob_implicit_flush(1);
			$level = ob_get_level();
			while ($level--){
				@ob_end_clean();
			}
			$this->output_is_disabled = true;
		}
	}

}
