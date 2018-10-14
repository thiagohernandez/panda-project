<?php

namespace PHPixie;

/**
 * ORM Module for PHPixie
 *
 * This module allows you to instantly turn your tables 
 * into Models and specify their relations in a simple way.
 *
 * @see \PHPixie\DB\Query
 * @package    DB
 */
class ORM {
	
	/**
	 * Pixie Dependency Container
	 * @var \PHPixie\Pixie
	 */
	public $pixie;
	
	/**
	 * Cache of ORM table's columns
	 * @var array
	 */
	public $column_cache = array();
	public $column_name_cache = array();

	/**
	 * Cache of ORM object's with default values
	 * @var array
	 */
	public $object_cache = array();

	/**
	 * Initializes the ORM module
	 * 
	 * @param \PHPixie\Pixie $pixie Pixie dependency container
	 */
	public function __construct($pixie) {
		$this->pixie = $pixie;
	}
	
	
	/**
	 * Throw away all my cached data
	 *
	 * Use this when you're altering DB tables
	 */
	public static function destroy_caches() {
		$column_cache = array();
		$column_name_cache = array();
		$object_cache = array();
	}
	
	
	/**
	 * Initializes ORM model by name, and optionally fetches an item by id
	 *
	 * @param string  $name Model name
	 * @param mixed $id   If set ORM will try to load the item with this id from the database
	 * @return \PHPixie\ORM\Model   ORM model, either empty or preloaded
	 */
	public function get($name, $id = null)
	{
		$name = explode('_', $name);
		$name = array_map('ucfirst', $name);
		$name = implode("\\", $name);
		$model = "\\App\\Model\\".$name;
		$model = new $model($this->pixie);
		if ($id != null)
		{
			$model = $model->where($model->id_field, $id)->find();
			$model->values(array($model->id_field => $id));
		}
		return $model;
	}
	
	/**
	 * Initializes an ORM Result with which model to use and which result to
	 * iterate over
	 *
	 * @param string          $model  Model name
	 * @param \PHPixie\DB\Result $dbresult Database result
	 * @param array           $with Array of rules for preloaded relationships
	 * @return \PHPixie\ORM\Result Initialized Result
	 */
	public function result($model, $dbresult, $with = array()) {
		return new \PHPixie\ORM\Result($this->pixie, $model, $dbresult, $with);
	}
	
	/**
	 * Initializes an ORM Model Extension.
	 *
	 * @param string $class  Extension class name
	 * @param \PHPixie\ORM\Model $model Associated Model
	 * @return \PHPixie\ORM\Extension Initialized Extension
	 */
	public function extension($class, $model) {
		return new $class($this->pixie, $model);
	}

	
	/**
	 * Gets plural form of a noun
	 *
	 * @param string  $str Noun to get a plural form of
	 * @return string  Plural form
	 */
	public static function plural($str)
	{
		$regexes = array(
			'/^(.*?[sxz])$/i' => '\\1es',
			'/^(.*?[^aeioudgkprt]h)$/i' => '\\1es',
			'/^(.*?[^aeiou])y$/i' => '\\1ies',
		);
		foreach ($regexes as $key => $val) {
			$str = preg_replace($key, $val, $str, -1, $count);
			if ($count) {
				return $str;
			}
		}
		return $str.'s';
	}

	/**
	 * Gets singular form of a noun
	 *
	 * @param string $str Noun to get singular form of
	 * @return string Singular form of the noun
	 */
	public static function singular($str)
	{
		$regexes = array(
			'/^(.*?us)$/i' => '\\1',
			'/^(.*?[sxz])es$/i' => '\\1',
			'/^(.*?[^aeioudgkprt]h)es$/i' => '\\1',
			'/^(.*?[^aeiou])ies$/i' => '\\1y',
			'/^(.*?)s$/' => '\\1',
		);
		foreach ($regexes as $key => $val) {
			$str = preg_replace($key, $val, $str, -1, $count);
			if ($count) {
				return $str;
			}
		}
		return $str;
	}

	/**
	 * Get model foreign key name from model name
	 *
	 * @param string $model_name      Name of the model
	 *
	 * @return string  Foreign key for specified model name.
	 */
	public static function model_key($model_name) {
		return str_replace("\\", '_', $model_name).'_id';
	}
}
