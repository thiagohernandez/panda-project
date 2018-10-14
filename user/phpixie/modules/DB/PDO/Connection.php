<?php

namespace PHPixie\DB\PDO;
use PHPixie\DB\Result;

/**
 * PDO Database implementation.
 * @package Database
 */
class Connection extends \PHPixie\DB\Connection
{

	public $pixie;
	
	/**
	 * Connection object
	 * @var \PDO
	 * @link http://php.net/manual/en/class.pdo.php
	 */
	public $conn;

	/**
	 * Type of the database, e.g. mysql, pgsql etc.
	 * @var string
	 */
	public $db_type;

    /**
     * Initializes database connection
     *
     * @param \PHPixie\Pixie $pixie
     * @param string $config Name of the connection to initialize
     * @throws \Exception
     * @return \PHPixie\DB\PDO\Connection
     */
	public function __construct($pixie, $config)
	{
		parent::__construct($pixie, $config);
		
		$this->conn = new \PDO(
			$pixie->config->get("db.{$config}.connection"),
			$pixie->config->get("db.{$config}.user", ''),
			$pixie->config->get("db.{$config}.password", '')
		);
		$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$this->db_type = strtolower(str_replace('PDO_', '', $this->conn->getAttribute(\PDO::ATTR_DRIVER_NAME)));
		if ($this->db_type != 'sqlite') {
			$this->conn->exec("SET NAMES 'utf8'");
		}
	}

	/**
	 * Builds a new Query implementation
	 *
	 * @param string $type Query type. Available types: select,update,insert,delete,count
	 * @return Query  Returns a PDO implementation of a Query.
	 * @see Query_Database
	 */
	public function query($type)
	{
		return $this->pixie->db->query_driver('PDO', $this, $type);
	}

	/**
	 * Gets the id of the last inserted row.
	 *
	 * @return mixed Row id
	 */
	public function insert_id()
	{
		if ($this->db_type == 'pgsql')
		{
			return $this->execute('SELECT lastval() as id')->current()->id;
		}
		return $this->conn->lastInsertId();
	}

	/**
	 * Gets column info for the specified table
	 *
	 * @param string $table Name of the table to get columns from
	 * @return array Array of column info indexed by name
	 */
	private function strip_quotes($val) {
		if ($val !== null) {
			$len = strlen($val);
			if ($len > 1) {
				if 			(($val[0] === "'") && ($val[$len-1] === "'"))	{	$val = substr($val, 1, $len-2);	}
				else if (($val[0] === '"') && ($val[$len-1] === '"')) {	$val = substr($val, 1, $len-2);	}
			}
		}
		return $val;
	}
	public function get_column_info($table)
	{
		$debug = false;
		if ($debug) {
			echo "<pre>Get column info for: $table</pre>";
		}
		$columns = array();
		if ($this->db_type == 'mysql') {
			if ($debug) {echo'<pre>';}
			$table_desc = $this->execute("DESCRIBE `$table`");
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
		}
		else if ($this->db_type == 'sqlite') {
			if ($debug) {echo'<pre>';}
			$table_desc = $this->execute("PRAGMA table_info('$table')");
			foreach ($table_desc as $column) {
				if ($debug) {echo 'SQLITE said: '.json_encode((array)$column,JSON_PRETTY_PRINT).PHP_EOL;}
				$size = 0;
				$type = strtolower($column->type);
				$dflt = $this->strip_quotes($column->dflt_value);
				if (($type === 'integer') && ($column->pk == 1))	{
					$type = 'id';
				}
				else if (strpos($type,'varchar') !== false) {
					$pos = strpos($type,'(');
					if ($pos !== false) {
						$size = intval(substr($type,$pos+1));
						$type = 'varchar';
					}
				}
				else if (strpos($type,'int') !== false) {
					$dflt = (int)$dflt;
				}
				else if (strpos($type,'float') !== false) {
					$dflt = (double)$dflt;
				}
				$name = $column->name;
				$columns[$name] = array(
					'type' => $type,
					'size' => $size,
					'notnull' => ($column->notnull==='1'),
					'default' => $dflt
				);
				if ($debug) {echo 'Info: "'.$name.'" '.json_encode($columns[$name],JSON_PRETTY_PRINT).PHP_EOL;}
			}
			if ($debug) {echo'</pre>';die;}
		}
		else if ($this->db_type == 'pgsql') {
			throw new \Exception("PDO\Connection::get_column_info() - pgsql isn't fully supported yet");
			$table_desc = $this->execute("select column_name from information_schema.columns where table_name = '{$table}' and table_catalog=current_database();");
			foreach ($table_desc as $column) {
				$columns[] = $column->column_name;
			}
		}
		else {
			throw new \Exception("PDO\Connection::get_column_info() - your DB type isn't supported yet");
		}
		return $columns;
	}

	/**
	 * Executes a prepared statement query
	 *
	 * @param string $query A prepared statement query
	 * @param array $params Parameters for the query
	 * @throws \Exception
	 * @return Result    PDO implementation of a database result
	 * @see Database_Result
	 */
	public function execute($query, $params=array())
	{
		// Log the query
		if (empty($params)) {
			$this->pixie->debug->sql($query);
			//echo($this->db_type.': '.$query);die;
		}
		else {
			$pp = array();
			foreach ($params as $p) {
				$pp[] = utf8_encode($p);
			}
			$this->pixie->debug->sql($this->db_type.': '.$query.'; '.json_encode($pp));
			//echo($this->db_type.': '.$query.'; '.json_encode($pp));die;
		}
		// Execute the query
		$cursor = $this->conn->prepare($query);
		if (!$cursor->execute($params)) {
			$error = $cursor->errorInfo();
			$this->pixie->debug->sql($query.'; '.json_encode($params));
			throw new \Exception("Database error:\n".$error[2]." \n in query:\n{$query}");
		}
		return $this->pixie->db->result_driver('PDO', $cursor);
	}

}
