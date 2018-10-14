<?php

namespace PHPixie\DB\PDO;

/**
 * PDO implementation of the database Query
 * @package Database
 *
 */
class Query extends \PHPixie\DB\Query
{

	/**
	 * Type of the database, e.g. mysql, pgsql etc.
	 * @var string
	 */
	protected $_db_type;

	/**
	 * Character to use for quoting fields
	 * @var string
	 */
	protected $_quote;

    /**
     * Creates a new query object, checks which driver we are using and set the character used for quoting
     *
     * @param \PHPixie\DB\PDO\Connection $db Database connection
     * @param string $type Query type. Available types: select, update, insert, delete, count
     * @return \PHPixie\DB\PDO\Query
     * @see \PHPixie\DB\Query::__construct()
     */
	public function __construct($db, $type)
	{
		parent::__construct($db, $type);
		$this->_db_type = $this->_db->db_type;
		$this->_quote = $this->_db_type == 'mysql' ? '`' : '"';
	}

	/**
	 * Puts quotes around a string
	 *
	 * @param string $str     String to be enclosed in quotes
	 * @return string  String surrounded with quotes
	 */
	protected function quote($str)
	{
		return $this->_quote.$str.$this->_quote;
	}

	/**
	 * If a string is passed escapes a field by enclosing it in specified quotes.
	 * If you pass an \PHPixie\DB\Expression object the value will be inserted into the query unescaped
	 *
	 * @param mixed $field     Field to be escaped or an \PHPixie\DB\Expression object
	 *                         if the field must not be escaped
	 * @return string  Escaped field representation
	 * @see \PHPixie\DB\Expression
	 */
	public function escape_field($field, $prepend_table = true)
	{
		if (is_object($field) && ($field instanceof \PHPixie\DB\Expression)) {
			return $field->value;
		}
		$field = explode('.', $field);
		if (count($field) == 1) {
			if(!$prepend_table) {
				return $this->quote($field[0]);
			}
			array_unshift($field, $this->last_alias());
		}
		$str = $this->quote($field[0]).'.';
		if (trim($field[1]) == '*') {
			return $str.'*';
		}
		return $str.$this->quote($field[1]);
	}

	/**
	 * Replaces the value with ? and appends it to the parameters array
	 * If you pass an \PHPixie\DB\Expression object the value will be inserted into the query unescaped
	 * @param mixed $val     Value to be escaped or an \PHPixie\DB\Expression object
	 *                       if the value must not be escaped
	 * @param array  &$params Reference to parameters array
	 * @return string  Escaped value representation
	 */
	public function escape_value($val, &$params)
	{
		if ($val instanceof \PHPixie\DB\Expression) {
			foreach($val->params as $p) {
					$params[] = $p;
			}
			return $val->value;
		}
		else if ($val instanceof \PHPixie\DB\Query) {
			return $this->subquery($val, $params);
		}
		$params[] = $val;
		return '?';
	}

	/**
	 * Gets the SQL for a subquery and appends its parameters to current ones
	 *
	 * @param \PHPixie\DB\Query $query Query builder for the subquery
	 * @param array  &$params Reference to parameters array
	 * @return string  Subquery SQL
	 */
	protected function subquery($query, &$params) {
		$query = $query->query();
		$params = array_merge($params, $query[1]);
		return "({$query[0]}) ";
	}

	/**
	 * Gets the SQL for a table to select from
	 *
	 * @param string|\PHPixie\DB\Expression|\PHPixie\DB\Query|array $table Table representation
	 * @param array &$params Reference to parameters array
	 * @throws \Exception
	 * @internal param $string &alias   Alias for this table
	 * @return string  Table SQL
	 */
	public function escape_table($table, &$params) {
		$alias = null;
		if (is_array($table)) {
			$alias = $table[1];
			$table = $table[0];
		}

		if (is_string($table)) {
			$table = $this->quote($table);
			if ($alias != null)
				$table.= " AS {$this->quote($alias)}";
			return $table;
		}

		if ($alias == null) {
			$alias = $this->last_alias();
		}

		if ($table instanceof \PHPixie\DB\Query) {
			return "{$this->subquery($table, $params)} AS {$this->quote($alias)}";
		}

		if ($table instanceof \PHPixie\DB\Expression) {
			return "({$table->value}) AS {$this->quote($alias)}";
		}
		throw new \Exception("Parameter type ".get_class($table)." cannot be used as a table");
	}

	/**
	 * Builds a query and fills the $params array with parameter values
	 *
	 * @throws \Exception
	 * @return array     An array with a prepared query string and an array of parameters
	 */
	public function query()
	{

		$query = '';
		$params = array();

		if ($this->_type === 'insert') {
			$query .= "INSERT INTO {$this->escape_table($this->_table, $params)} ";
			if (empty($this->_data) && ($this->_db_type == 'pgsql')) {
				$query.= "DEFAULT VALUES ";
			}
			else {
				if(isset($this->_data[0]) && is_array($this->_data[0])) {
					// Batch insert
					$first_row = true;
					$columns_array = array();
					foreach($this->_data as $row) {
						$columns = '';
						$values = '';
						$comma = '';
						if ($first_row) {
							foreach ($row as $key => $val) {
								$values .= $comma;
								$columns .= $comma;
								$columns .= $this->quote($key);
								$columns_array[] = $key;
								$values .= $this->escape_value($val, $params);
							}
							$query .= "({$columns}) VALUES({$values})";
						}
						else {
							foreach ($columns_array as $col) {
								$values .= $comma;
								$values .= $this->escape_value($row[$col], $params);
							}
							$query .= ", ({$values})";
						}
						$comma = ', ';
						$first_row = false;
					}
				}
				else {
					// Insert a single row
					$columns = '';
					$values = '';
					$comma = '';
					foreach ($this->_data as $key => $val) {
						$values .= $comma;
						$columns .= $comma;
						$comma = ', ';
						$columns .= $this->quote($key);
						$values .= $this->escape_value($val, $params);
					}
					$query .= "({$columns}) VALUES({$values})";
				}
			}
		}
		else {
			if ($this->_type === 'select') {
				$query .= "SELECT ";
				if ($this->_fields == null) {
					$query .= "* ";
				}
				else {
					$comma = '';
					foreach ($this->_fields as $f) {
						$query .= $comma;
						$comma = ', ';
						if (is_array($f)) {
							$query .= "{$this->escape_field($f[0])} AS {$this->quote($f[1])} ";
						}
						else {
							$query .= "{$this->escape_field($f)} ";
						}
					}
				}
				if(!empty($this->_table)) {
					$query .= "FROM {$this->escape_table($this->_table, $params)} ";
				}
			}
			else if ($this->_type === 'count') {
				$query .= "SELECT COUNT(*) as {$this->quote('count')} FROM {$this->escape_table($this->_table, $params)} ";
			}
			
			// Transactions (added by FTB)
			else if ($this->_type === 'begin') {
				if 			($this->_db_type === 'sqlite') 	{	$query .= "BEGIN TRANSACTION";	}
				else if ($this->_db_type === 'mysql') 	{	$query .= "START TRANSACTION";	}
			}
			else if ($this->_type === 'commit') {
				$query .= "COMMIT";		// Works on both
			}

			else if ($this->_type === 'delete') {
				if (empty($this->_joins)) {
					$query .= "DELETE FROM {$this->escape_table($this->_table, $params)} ";
				}
				else {
					if ($this->_db_type == 'sqlite') {
						throw new \Exception("SQLite doesn't support deleting a table with JOIN in the query");
					}
					$query .= "DELETE {$this->last_alias()}.* FROM {$this->escape_table($this->_table, $params)} ";
				}
			}
			else if ($this->_type === 'update') {
				$query .= "UPDATE {$this->escape_table($this->_table, $params)} ";
			}

			foreach ($this->_joins as $join) {
				$table = $join[0];
				$table = $this->escape_table($table, $params);
				$query .= strtoupper($join[1])." JOIN {$table} ";
				if(!empty($join[2])) {
					$query.="ON {$this->get_condition_query($join[2], $params, true, true)} ";
				}
			}
			
			if ($this->_type === 'update') {
				$query.= "SET ";

				$comma = '';
				foreach ($this->_data as $key => $val) {
					$query .= $comma;
					$comma = ', ';
					$query .= "{$this->quote($key)} = {$this->escape_value($val, $params)}";
				}
				$query .= " ";
			}
			
			if (!empty($this->_conditions)) {
				$query .= "WHERE {$this->get_condition_query($this->_conditions, $params, true)} ";
			}
			if ((($this->_type=='select') || ($this->_type=='count')) && ($this->_group_by!=null)) {
				$query .= "GROUP BY {$this->escape_field($this->_group_by, false)} ";
			}
			if ((($this->_type=='select') || ($this->_type=='count')) && !empty($this->_having)) {
				$query .= "HAVING {$this->get_condition_query($this->_having, $params, true)} ";
			}

			if (($this->_type=='select') && !empty($this->_order_by)) {
				$query .= "ORDER BY ";
				$comma = '';
				foreach ($this->_order_by as $order) {
					$query .= $comma;
					$comma = ', ';
					$query .= $this->escape_field($order[0])." ";
					if (isset($order[1])) {
						$dir = strtoupper($order[1]);
						$query .= $dir." ";
					}
				}
			}

			if ((count($this->_union) > 0) && ($this->_type == 'select'))	{
				$query = "({$query}) ";
				foreach ($this->_union as $union) {
					$query .= $union[1] ? "UNION ALL " : "UNION ";
					if ($union[0] instanceof \PHPixie\DB\Query) {
						$query .= $this->subquery($union[0], $params);
					}
					elseif ($union[0] instanceof \PHPixie\DB\Expression) {
						$query .= "({$union[0]->value}) ";
					}
					else {
						throw new \Exception("You can only use query builder instances or \$pixie->db->expr() for unions");
					}
				}
			}

			if ($this->_type !== 'count') {
				if ($this->_limit != null) {
					$query .= "LIMIT {$this->_limit} ";
				}
				if ($this->_offset != null) {
					$query .= "OFFSET {$this->_offset} ";
				}
			}
		}
		return array($query, $params);
	}

	/**
	 * Recursively parses conditions array into a query string
	 *
	 * @param array     $p                   Element of the cobditions array
	 * @param array   &$params             	 Reference to parameters array
	 * @param boolean   $skip_first_operator Flag to skip the first logical operator in a query
	 *                                       to prevent AND or OR to be at the beginning of the query
	 * @param boolean   $value_is_field      Flag if the the value in the logical operations should
	 *                                       be treated as a field. E.g. for joins where the fields are
	 *                                       compared between themselves and not with actual values
	 * @return string     String representation of the conditions
	 * @throws \Exception If condition cannot be parsed
	 */
	public function get_condition_query($p, &$params, $skip_first_operator, $value_is_field = false) {
		if (isset($p['field'])) {
			$operator = $p['operator'];
			if ($value_is_field) {
				$param = $this->escape_field($p['value']);
			}
			else {
				$val = $p['value'];
				// Modified by FTB to allow 'IS NULL' and 'IS NOT NULL'
				if (is_null($val)) {
					$param = 'NULL';
					if ($operator === '=') {
						$operator = 'IS';
					}
					else if ($operator === '!=') {
						$operator = 'IS NOT';
					}
					else {
						throw new \Exception('Bad operator used with NULL value');
					}
				}
				else {
					$param = $this->escape_value($p['value'], $params);
				}
			}
			return $this->escape_field($p['field']).' '.$operator.' '.$param;
		}
		if (isset($p['logic'])) {
			return ($skip_first_operator ? '' : strtoupper($p['logic']).' ')
				.$this->get_condition_query($p['conditions'], $params, false, $value_is_field);
		}

		$conds = '';
		$skip = $skip_first_operator || (count($p) > 1);
		foreach ($p as $q) {
			$conds .= $this->get_condition_query($q, $params, $skip, $value_is_field).' ';
			$skip = false;
		}
		if (count($p) > 1 && !$skip_first_operator) {
			return "( ".$conds.")";
		}
		return $conds;
	}

}
