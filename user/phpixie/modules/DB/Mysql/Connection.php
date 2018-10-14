<?php

namespace PHPixie\DB\Mysql;
use PHPixie\DB\Query;
use PHPixie\DB\Result;

/**
 * Mysqli Database Implementation
 * @package Database
 */
class Connection extends \PHPixie\DB\Connection
{
	
	/**
	 * Mysqli database connection object
	 * @var \mysqli
	 * @link http://php.net/manual/en/class.mysqli.php
	 */
	public $conn;

	/**
	 * Type of the database, mysql.
	 * @var string
	 */
	public $db_type = 'mysql';

    /**
     * Initializes database connection
     *
     * @param \PHPixie\Pixie $pixie
     * @param string $config Name of the connection to initialize
     * @throws \Exception
     * @return \PHPixie\DB\Mysql\Connection
     */
	public function __construct($pixie, $config)
	{
		parent::__construct($pixie, $config);
		
		$this->conn = mysqli_connect(
			$pixie->config->get("db.{$config}.host", 'localhost'),
			$pixie->config->get("db.{$config}.user", ''),
			$pixie->config->get("db.{$config}.password", ''),
			$pixie->config->get("db.{$config}.db")
		);
		$this->conn->set_charset("utf8");
	}

    /**
     * Gets column names for the specified table
     *
     * @param string $table Name of the table to get columns from
     * @throws \Exception
     * @return array Array of column names
     * @throw \Exception if table doesn't exist
     */
	public function get_column_info($table)
	{
		$debug = false;
		$columns = array();
		if ($debug) {echo'<pre>';}
		$table_desc = $this->execute("DESCRIBE `$table`");
		if (!$table_desc->valid()) {
			throw new \Exception("Table '{$table}' doesn't exist");
		}
		foreach ($table_desc as $column) {
			if ($debug) {echo json_encode((array)$column,JSON_PRETTY_PRINT).PHP_EOL;}
			$size = 0;
			$type = $column->Type;
			if ($column->Key === 'PRI') {
				$type = 'id';
			}
			else if (strpos($type,'varchar')!==false) {
				$pos = strpos($type,'(');
				if ($pos!==false) {
					$size = intval(substr($type,$pos+1));
					$type = 'varchar';
				}
			}
			$name = $column->Field;
			$columns[$name] = array(
				'type' => $type,
				'size' => $size,
				'notnull' => ($column->Null==='NO')? true:false,
				'default' => $column->Default
			);
			if ($debug) {echo '"'.$name.'" '.json_encode($columns[$name],JSON_PRETTY_PRINT).PHP_EOL;}
		}
		if ($debug) {echo'</pre>';die;}
		return $columns;
	}

	/**
	 * Builds a new Query implementation
	 *
	 * @param string $type Query type. Available types: select,update,insert,delete,count
	 * @return Query  Returns a Mysqli implementation of a Query.
	 * @see Query_Database
	 */
	public function query($type)
	{
		return $this->pixie->db->query_driver('Mysql', $this, $type);
	}

	/**
	 * Gets the id of the last inserted row.
	 *
	 * @return mixed Row id
	 */
	public function insert_id()
	{
		return $this->conn->insert_id;
	}

	/**
	 * Executes a prepared statement query
	 *
	 * @param string   $query  A prepared statement query
	 * @param array     $params Parameters for the query
	 * @return Result    Mysqli implementation of a database result
	 * @throws \Exception If the query resulted in an error
	 * @see Database_Result
	 */
	public function execute($query, $params = array())
	{
		$cursor = $this->conn->prepare($query);
		if (!$cursor)
			throw new \Exception("Database error: {$this->conn->error} \n in query:\n{$query}");
		$types = '';
		$bind = array();
		$refs = array();
		if (!empty($params))
		{
			foreach ($params as $key => $param)
			{
				$refs[$key] = is_array($param) ? $param[0] : $param;
				$bind[] = &$refs[$key];
				$types .= is_array($param) ? $param[1] : 's';
			}
			array_unshift($bind, $types);

			call_user_func_array(array($cursor, 'bind_param'), $bind);
		}
		if ($cursor->execute() === false) {
			throw new \Exception("Database error: {$this->conn->error} \n in query:\n{$query}");
		}
		$res = $cursor->get_result();
		return $this->pixie->db->result_driver('Mysql', $res);
	}

}
