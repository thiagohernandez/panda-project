<?php

namespace PHPixie;

/**
 * Database Module for PHPixie
 *
 * This module allows you to access the database. Currently
 * PDO and Mysqli drivers are supported. PDO drivers can access Mysql, 
 * SQLite and PostgreSQL databases.
 *
 * @see \PHPixie\DB\Query
 * @package    DB
 */
class DB {
	
	/**
	 * Pixie Dependancy Container
	 * @var \PHPixie\Pixie
	 */
	public $pixie;
	
	/**
	 * Database connection instances
	 * @var \PHPixie\DB\Connection
	 */
	protected $db_instances = array();
	
	/**
	 * Initializes the database module
	 * 
	 * @param \PHPixie\Pixie $pixie Pixie dependency container
	 */
	public function __construct($pixie) {
		$this->pixie = $pixie;
	}
	
	/*
	 * SQL 'DATE' and 'DATETIME' formats, eg. "YYYY-MM-DD, added by FTB
	 */
	public $sql_date = 'Y-m-d';
	public $sql_datetime = 'Y-m-d H:i:s';

	/**
	 * Gets an instance of a connection to the database
	 *
	 * @param string  $config Configuration name of the connection.
	 *                        Defaults to  'default'.
	 * @return \PHPixie\DB\Connection  Driver implementation of the Connection class.
	 */
	public function get($config = 'default') {
		if (!isset($this->db_instances[$config])) {
			$driver = $this->pixie->config->get("db.{$config}.driver");
			$driver = "\\PHPixie\\DB\\".$driver."\\Connection";
			$this->db_instances[$config] = new $driver($this->pixie, $config);
		}
		return $this->db_instances[$config];
	}
	
	/**
	 * Builds a query for specified connection.
	 *
	 * @param string $type   Query type. Available types: select,update,insert,delete,count
	 * @param string  $config Configuration name of the connection.
	 *                        Defaults to  'default'.
	 * @return \PHPixie\DB\Query  Driver implementation of the Query class.
	 */
	public function query($type, $config = 'default')
	{
		return $this->get($config)->query($type);
	}

	/**
	 * Gets the id of the last inserted row
	 *
	 * @param string  $config Configuration name of the connection.
	 *                        Defaults to  'default'.
	 * @return mixed Id of the last inserted row
	 */
	public function insert_id($config = 'default')
	{
		return $this->get($config)->insert_id();
	}
	
	/**
	 * Gets column info for the specified table
	 *
	 * @param string $table Name of the table to get columns from
	 * @param string  $config Configuration name of the connection.
	 * 
	 * @return array Array of column info indexed by column name (type, size, notnull, default)
	 */
	public function get_column_info($table, $config = 'default') {
		return $this->get($config)->get_column_info($table);
	}
	
	/**
	 * Returns an Expression representation of the value.
	 * Values wrapped inside Expression are not escaped in queries
	 *
	 * @param mixed $value  Value to be wrapped
     * @param array $params Escaped parameters
	 * @return \PHPixie\Db\Expression  Raw value that will not be escaped during query building
	 */
	public function expr($value, $params = array()) {
		return new \PHPixie\DB\Expression($value, $params);
	}
	
	/*
	 * Creates a new query
	 *
	 * @param string $driver Database driver name
	 * @param \PHPixie\DB\Connection $db   Database connection
	 * @param string $type Query type. Available types: select, update, insert, delete, count
	 * @return \PHPixie\DB\Query
	 */
	public function query_driver($driver, $db, $type) {
		$driver = "\\PHPixie\\DB\\".$driver."\\Query";
		return new $driver($db, $type);
	}
	
	/*
	 * Creates a new result
	 *
	 * @param string $driver Database driver name
	 * @param object $cursor Datbase result cursor
	 * @return \PHPixie\DB\Result
	 */
	public function result_driver($driver, $cursor) {
		$driver = "\\PHPixie\\DB\\".$driver."\\Result";
		return new $driver($cursor);
	}

}
