<?php

namespace PHPixie\ORM;

/**
 * ORM allows you to access database items and their relationships in an OOP manner,
 * it is easy to setup and makes a lot of use of naming convention.
 *
 * @method mixed limit(int $limit = null) Set number of rows to return.
 *               If NULL is passed than no limit is used.
 *               Without arguments returns current limit, returns self otherwise.
 *
 * @method mixed offset(int $offset = null) Set the offset for the first row in result.
 *               If NULL is passed than no limit is used.
 *               Without arguments returns current offset, returns self otherwise.
 *
 * @method mixed order_by(string $column, string $dir) Adds a column to ordering parameters
 *
 * @method mixed where(mixed $key, mixed $operator = null, mixed $val = null) behaves just like Query_Database::where()
 *
 * @see Query_Database::where()
 * @package ORM
 */
class Model
{
	/**
	 * Pixie Dependancy Container
	 * @var \PHPixie\Pixie
	 */
	public $pixie;

	/**
	 * The name of the model
	 * @var string
	 */
	public $model_name;

	/**
	 * Database Connection
	 * @var \PHPixie\DB\Connection
	 */
	public $conn;
	
	/**
	 * Specifies which table the model will use, can be overridden
	 * @var string
	 */
	public $table = null;

	/**
	 * The database connection to use for this model.
	 * nb. My relations have to use the same connection...
	 */
	public $connection = 'default';

	/**
	 * Specifies which column is treated as PRIMARY KEY
	 * @var string
	 */
	public $id_field = 'id';

	/**
	 * You can override this to set default column/value pairs for new instances of your model
	 */
	protected $defaults = array();

	/**
	 * Override these to define my database relations
	 */
	protected $belongs_to = array();
	protected $has_one = array();
	protected $has_many = array();

	/**
	 * My related objects (as loaded from the database)
	 * @var array
	 */
	public $related_objects = array();

	/**
	 * Associated query builder
	 * @var \PHPixie\DB\Query
	 */
	public $query;

	/**
	 * An instance of the database connection
	 * @var DB
	 */
	protected $db;

	/**
	 * Current row returned by the database
	 * @var array
	 */
	protected $_row = array();

	/**
	 * A flag whether the row was loaded from the database
	 * @var boolean
	 */
	protected $_loaded = false;

	/**
	 * Relationships to be preloaded
	 * @var array
	 */
	protected $_with = array();
	
	/**
	 * If the default columns have been loaded
	 * @var boolean
	 */
	protected $defaults_loaded = false;
	
	/**
	 * Constructs the model. To use ORM it is enough to
	 * just create a model like this:
	 * <code>
	 * class App\Model\Fairy extends \PHPixie\ORM\Model { }
	 * </code>
	 * By default it will assume that the name of your table
	 * is the plural form of the models' name, the PRIMARY KEY is id,
	 * and will use the 'default' connection. This behaviour is easy to be
	 * changed by overriding $table, $id and $db properties.
	 *
	 * @param \PHPixie\Pixie $pixie Pixie dependency container
	 * @return void
	 * @see $table
	 * @see $id
	 * @see $db
	 */
	public function __construct($pixie)
	{
		$this->pixie = $pixie;
		$this->conn = $pixie->db->get($this->connection);
		$this->query = $this->conn->query('select');
		$this->model_name = strtolower(get_class($this));
		$this->model_name = str_ireplace("App\\Model\\", '', $this->model_name);

		if ($this->table == null) {
			$this->table = str_replace("\\", '_', $this->model_name);
			$this->table = $this->pixie->orm->plural($this->table);
		}
		$this->query->table($this->table);

		foreach (array('belongs_to', 'has_one', 'has_many') as $rels) {
			$normalized = array();
			foreach ($this->$rels as $key => $rel) {
				if (!is_array($rel)) {
					$key = $rel;
					$rel = array();
				}
				$normalized[$key] = $rel;
				if (!isset($rel['model'])) {
					$rel['model'] = $normalized[$key]['model'] = (($rels=='has_many') ? $this->pixie->orm->singular($key) : $key);
				}

				$normalized[$key]['type'] = $rels;
				if (!isset($rel['key'])) {
					$normalized[$key]['key'] = $this->pixie->orm->model_key( ($rels!='belongs_to') ? $this->model_name : $rel['model']);
				}

				if (($rels == 'has_many') && isset($rel['through'])) {
					if (!isset($rel['foreign_key'])) {
						$normalized[$key]['foreign_key'] = $this->pixie->orm->model_key($rel['model']);
					}
				}
				$normalized[$key]['name'] = $key;
			}
			$this->$rels = $normalized;
			//$this->pixie->debug->pretty($normalized);die;
		}
	}
	
	/**
	 * Get this item's database id
	 */
	public function id() {
		if ($this->loaded()) {
			return $this->_row[$this->id_field];
		}
		return null;
	}
	
	/**
	 * Checks if the item is considered to be loaded from the database
	 *
	 * @return boolean Returns True if the item was loaded
	 */
	public function loaded() {
		return $this->_loaded;
	}

	/**
	 * Returns the row associated with current ORM item as an associative array
	 *
	 * @return array  Associative array representing the row
	 */
	public function as_array() {
		$this->init_columns();			// Make sure the columns are valid
		return $this->_row;
	}

	/**
	 * Magic method for call Query_Database methods
	 *
	 * @param string $method      Method to call
	 * @param array $arguments Arguments passed to the method
	 * @return mixed  Returns self if parameters were passed. If no parameters where passed returns
	 *                current value for the associated parameter
	 * @throws \Exception If method doesn't exist
	 */
	public function __call($method, $arguments)
	{
		if (!in_array($method, array('limit', 'offset', 'order_by', 'where'))) {
			throw new \Exception("Method '{$method}' doesn't exist on .".get_class($this));
		}
		$res = call_user_func_array(array($this->query, $method), $arguments);
		if (empty($arguments)) {
			return $res;
		}
		return $this;
	}
	
	/**
	 * Prepares the relationships specified using with().
	 *
	 * @return array Relationship definitions used by \PHPixie\ORM\Result
	 * @throw  \Exception If the relationship specified using with() does not exist or is not of the belongs_to or has_one type
	 */
	private function get_relations() {
		return array_merge($this->has_one, $this->has_many, $this->belongs_to);
	}
	public function prepare_relations() {
		$paths = array();
		if (!empty($this->_with))	{
			$fields = array();
			$this_alias = $this->query->last_alias();
			foreach ($this->column_names() as $column) {
				$fields[] = array("{$this_alias}.{$column}", "{$this_alias}__{$column}");
			}
			foreach ($this->_with as $target) {
			
				$model = $this;
				$model_alias = $this_alias;
				$rels = explode('.', $target);
				
				foreach ($rels as $key => $rel_name) {
				
					$path = implode('.', array_slice($rels, 0, $key + 1));
					if (isset($paths[$path])) {
						$model = $paths[$path]['model'];
						$model_alias = $paths[$path]['alias'];
						continue;
					}
					
					$alias = str_replace('.', '_', $path);
					$model_rels = $model->get_relations();
					$rel = $this->pixie->arr($model_rels, $rel_name, false);

					if (!$rel) {
						throw new \Exception("Model '{$model->model_name}' doesn't have a '{$rel_name}' relation defined");
					}
					if ($rel['type'] == 'has_many') {
						throw new \Exception("Relationship '{$rel_name}' is of has_many type and cannot be preloaded view with()");
					}
					$rel_model = $this->pixie->orm->get($rel['model']);

					if ($rel['type'] == 'belongs_to') {
						$this->query->join(array($rel_model->table, $alias), array(
							$model_alias.'.'.$rel['key'],
							$alias.'.'.$rel_model->id_field,
							), 'left');
					}
					else{
						$this->query->join(array($rel_model->table, $alias), array(
							$model_alias.'.'.$model->id_field,
							$alias.'.'.$rel['key'],
							), 'left');
					}

					foreach ($rel_model->column_names() as $column) {
						$fields[] = array("{$alias}.{$column}", "{$alias}__{$column}");
					}
					$model = $rel_model;
					$model_alias = $alias;
					$paths[$path] = array('alias' => $alias, 'model' => $model);
				}
			}

			call_user_func_array(array($this->query, 'fields'), $fields);
		}
		return $paths;
	}
	
	/**
	 * Finds all rows that meet set criteria.
	 *
	 * @return \PHPixie\ORM\Result Returns ORM Result that you can use in a 'foreach' loop.
	 */
	public function find_all()
	{
		$paths = $this->prepare_relations();
		return $this->pixie->orm->result($this->model_name, $this->query->execute(), $paths);
	}

	/**
	 * Searches for the first row that meets set criteria. If no rows match it still returns an ORM model
	 * but with its loaded() flag being False. calling save() on such an object will insert a new row.
	 *
	 * @return \PHPixie\ORM\Model Found item or new object of the current model but with loaded() flag being False
	 */
	public function find()
	{
		$set_limit = $this->limit();
		$res = $this->limit(1)->find_all()->current();
		$this->limit($set_limit);
		return $res;
	}

	/**
	 * Counts all rows that meet set criteria. Ignores limit and offset.
	 *
	 * @return int Number of rows
	 */
	public function count_all()
	{
		$query = clone $this->query;
		$query->type('count');
		return $query->execute();
	}

	/**
	 * Returns a clone of query builder that is being used to set conditions.
	 * It is useful for example if you let ORM manage building a complex query using it's relationship
	 * system, then you get the clone of that query and alter it to your liking,
	 * so there is no need to writing relationship joins yourself.
	 *
	 * @return \PHPixie\DB\Query A clone of the current query builder
	 */
	public function query()
	{
		return clone $this->query;
	}

	/**
	 * Magic method that allows to chech if the property exists on the model.
	 * Takes relationships and properties defined using get() into account.
	 * @param string   $column Name of the column, property or relationship to get
	 * @return boolean If the property exists
	 */
	public function __isset($property) {
		$this->init_columns();
		if (array_key_exists($property, $this->_row)) 						{	return true;	}
		if (array_key_exists($property, $this->related_objects)) 	{	return true;	}
		$relations = $this->get_relations();
		if ($this->pixie->arr($relations, $property, false)) {
			return true;
		}
		return false;
	}
	
	/**
	 * Magic method that allows accessing row columns as properties and also facilitates
	 * access to relationships.
	 *
	 * If a relationship is being accessed, it will return an ORM model of the related table
	 * and automatically alter its query so that all your previously set conditions will remain
	 *
	 * @param string   $column Name of the column, property or relationship to get
	 * @return mixed   Requested property
	 * @throws \Exception If neither property nor a relationship with such name is found
	 */
	public function __get($column) {

		// Properties of this object
		if (array_key_exists($column, $this->_row))							{ return $this->_row[$column];						}
		if (array_key_exists($column, $this->related_objects))	{	return $this->related_objects[$column];	}
		
		// If the object is uninitialised this will set default data using
		// the database description + default values supplied by the model
		if ($this->init_columns()) {
			// Recurse and see if the column magically appeared or not
			return $this->__get($column);
		}

		// 'column' not found, it might be an object related to me via ORM
		$relations = $this->get_relations();
		$target = $this->pixie->arr($relations, $column, false);
		if ($target) {
			// Yes, it's a related object
			$result = null;
			if ($this->loaded()) {
				// $this->pixie->debug->pretty($target);die;
				$orm = $this->pixie->orm;
				if ($target['type'] == 'belongs_to') {
					// Load it from the database
					$key = $target['key'];
					$result = $orm->get($target['model'], $this->$key);
					$this->attach($target,$result);
				}
				else if ($target['type'] == 'has_one') {
					$result = $orm->get($target['model'])
						->where($target['key'], $this->id())
						->find();
					$this->attach($target,$result);
				}
				else if ($target['type'] == 'has_many') {
					// Need to return a database query so that you can add more conditions before using "find_all()"
					$result = $orm->get($target['model'])
						->where($target['key'], $this->id())->find_all();
					if (isset($target['through'])) {
						throw new \Exception("You need to finish this!");
						/* Original PHPixie code
							if ($target['type'] == 'has_many' && isset($target['through'])) {
								$last_alias = $model->query->last_alias();
								$through_alias = $model->query->add_alias();
								$new_alias = $model->query->add_alias();
								$model->query->join(array($target['through'], $through_alias), array(
									$last_alias.'.'.$this->id_field,
									$through_alias.'.'.$target['key'],
									), 'inner');
								$model->query->join(array($model->table, $new_alias), array(
									$through_alias.'.'.$target['foreign_key'],
									$new_alias.'.'.$model->id_field,
									), 'inner');
							}*/
					}
				}
				return $result;
			}
			else {
				if ($target['type'] == 'belongs_to') {
					// Create an empty object
					return $this->pixie->orm->get($target['model']);
				}
				else if ($target['type'] == 'has_one') {
					// Create an empty object
					return $this->pixie->orm->get($target['model']);
				}
				else {
					throw new \Exception("You can't access a '{$target['type']}' relation on an unloaded object");
				}
			}
			
		}
		throw new \Exception("Property {$column} not found on {$this->model_name} model.");
	}

	/**
	 * Magic method to update record values when set as properties or to add an ORM item to
	 * a relation. By assigning an ORM model to a relationship a relationship is created between the
	 * current item and the passed one  Using properties this way is a shortcut to the add() method.
	 *
	 * @param string $column Column or relationship name
	 * @param mixed $val    Column value or an ORM model to be added to a relation
	 * @return void
	 * @see add()
	 */
	public function __set($column, $val)
	{
		$this->init_columns();
		// Is it a column in this object?
		if (array_key_exists($column,$this->_row)) {
			// Yes, set the value
			$this->_row[$column] = $val;
		}
		else {
			// Is 'column' one of my relations?
			$rels = $this->get_relations();
			$target = $this->pixie->arr($rels, $column, false);
			if ($target) {
				// Yes
				if ($val == null) {
					// Use null to detach an object (be careful!)
					$key = $target['key'];
					$this->_row[$key] = 0;										// Invalidate the key
					unset($this->related_objects[$column]);		// Unload the related object
				}
				else if ($val instanceof \PHPixie\ORM\Model) {
					$this->attach($target, $val);
				}
				else if (is_integer($val)) {
					// Change the foreign-key field for a related object?
					$key = $target['key'];
					$this->_row[$key] = $val;									// Set the new key
					unset($this->related_objects[$column]);		// Unload the related object
				}
				else {
					throw new \Exception("Bad assignment of related object '$column' in {$this->model_name}");
				}
			}
			else {
				throw new \Exception("Model {$this->model_name} doesn't have field '$column'");
			}
		}
	}

	/**
	 * Create a relationship between current item and another one
	 *
	 * @param string   $relation Name of the relationship
	 * @param \PHPixie\ORM\Model    $model    ORM item to create a relationship with
	 * @return void
	 * @throws \Exception If relationship is not defined
	 * @throws \Exception If current item is not in the database yet (isn't considered loaded())
	 * @throws \Exception If passed item is not in the database yet (isn't considered loaded())
	 */
	private function attach($rel, $model)
	{
		if ($model->model_name !== $rel['model']) {
			throw new \Exception("You tried to assign a '{$model->model_name}' object to field '{$rel['name']}'");
		}

		if ($rel['type'] == 'belongs_to') {
			$key = $rel['key'];
			$this->_row[$key] = $model->id();
			$this->related_objects[$rel['name']] = $model;
		}
		else if (isset($rel['through'])) {
			if (!$this->loaded()) {
				throw new \Exception("Model must be loaded before you try adding 'through' relationships to it.");
			}
			if (!$model->loaded()) {
				throw new \Exception("Model must be loaded before added to a 'through' relationship.");
			}

			$exists = $this->conn->query('count')
				->table($rel['through'])
				->where(array(
					array($rel['key'], $this->id()),
					array($rel['foreign_key'], $model->id())
				))
				->execute();
			if (!$exists) {
				$this->conn->query('insert')
					->table($rel['through'])
					->data(array(
						$rel['key'] => $this->id(),
						$rel['foreign_key'] => $model->id()
					))
					->execute();
			}
		}
		else {
			if (!$this->loaded()) {
				throw new \Exception("Model must be loaded before you try adding 'has_many' relationships to it.");
			}

			$key = $rel['key'];
			$model->$key = $this->id();
			if ($model->loaded()) {
				$model->save();
			}
		}
	}

	/**
	 * Gets name column names of the table associated with the model.
	 *
	 * @return array   Array of column names
	 */
	public function column_names() {
		$cache = &$this->pixie->orm->column_name_cache;
		if (!array_key_exists($this->table, $cache)) {
			$name_cache = &$cache[$this->table];
			$name_cache = array();
			$columns = $this->column_info();
			foreach ($columns as $c => $column) {
				$name_cache[] = $c;
			}
		}
		return $cache[$this->table];
	}

	/**
	 * Gets info about the columns of the table associated with the model.
	 *
	 * @return array   Array of column info
	 */
	public function column_info() {
		$cache = &$this->pixie->orm->column_cache;
		if (!array_key_exists($this->table, $cache)) {
			$cache[$this->table] = $this->conn->get_column_info($this->table);
		}
		return $cache[$this->table];
	}

	/*
	 * Init properties for model if not loaded, fill it with default values from the database
	 *
	 * Return 'true' if the columns were loaded (ie. the object was uninitialised)
	 */
	private function init_columns() {
		$result = false;
		if (!$this->loaded() && !$this->defaults_loaded) {
			// Have we loaded the defaults from the database?
			$cache = &$this->pixie->orm->object_cache;
			if (!array_key_exists($this->table,$cache)) {
				// No...load them
				$obj = &$cache[$this->table];
				$obj = array();
				$columns = $this->column_info();
				foreach ($columns as $name => $column) {
					$obj[$name] = $column['default'];
				}
			}
			// Copy the database defined default values to me
			$this->_row = $cache[$this->table];

			// Overwrite with user-defined default values
			foreach ($this->defaults as $key => $val) {
				$this->_row[$key] = $val;
			}

			// Set some flags
			$result = true;
			$this->defaults_loaded = true;
		}
		return $result;
	}

	/**
	 * Defines which relationships should be preloaded. You can only preload
	 * belongs_to and has_one relationships. You can use the dot notation to
	 * preload deep relationsips, e.g. 'tree.protector' will preload the tree
	 * that a fairy lives in and also preload the protector of that tree.
	 *
	 * @param string $relationsip,...   List of relationships to preload
	 * @return \PHPixie\ORM\Model Returns itself
	 */
	public function with() {
		$this->_with = func_get_args();
		return $this;
	}

	/**
	 * Deletes current item from the database
	 *
	 * @return void
	 * @throws \Exception If the item is not in the database, e.g. is not loaded()
	 */
	public function delete() {
		if (!$this->loaded()) {
			throw new \Exception("Cannot delete an item that wasn't loaded from the database");
		}
		$this->conn->query('delete')
			->table($this->table)
			->where($this->id_field, $this->id())
			->execute();
		$this->_loaded = false;
		$this->related_objects = array();
	}

	/**
	 * Deletes all items that meet set conditions. Use in the same way
	 * as you would a find_all() method.
	 *
	 * @return \PHPixie\ORM\Model Returns self
	 */
	public function delete_all() {
		$query = clone $this->query;
		$query->type('delete');
		$query->execute();
		return $this;
	}

	/**
	 * Saves the complete back to the database. If item is loaded() it will result
	 * in an update, otherwise a new row will be inserted
	 *
	 * @return \PHPixie\ORM\Model Returns self
	 */
	public function pre_save() {}		// Called before we save a Model
	public function save() {
		$this->pre_save();
		//echo "Saving a {$this->model_name}\n";
		if ($this->loaded()) {
			$query = $this->conn->query('update')
				->table($this->table)
				->where($this->id_field, $this->id());
		}
		else {
			$query = $this->conn->query('insert')
				->table($this->table);
		}
		// Make a copy of my data without the 'id' field (we never write that)
		$row = $this->_row;
		if (isset($row[$this->id_field])) {
			unset($row[$this->id_field]);		// Remove the ID
		}
		// Write it
		$query->data($row);
		$query->execute();

		// If the object was inserted the DB will have assigned an ID to it
		if (!$this->loaded()) {
			$this->_loaded = true;
			$this->_row[$this->id_field] = $this->conn->insert_id();		// Get the new ID
		}

		return $this;
	}

	/**
	 * Update named fields in the database
	 *
	 * This can be faster than saving the whole object when you only changed a few fields
	 */
	public function save_fields() {
		// eg. save_fields('foo','bar');
		$this->save_fields_array(func_get_args());
	}
	// An "array()" version of "save_fields()" - pass the field names in an array
	public function save_fields_array($fields) {
		if ($this->loaded()) {
			$data = array();
			foreach ($fields as $f) {
				//echo $this->_row[$f];
				if (array_key_exists($f,$this->_row)) {
					$data[$f] = $this->_row[$f];
				}
				else {
					throw new \Exception("You tried to update unknown field '$f' in an object");
				}
			}
			if (!empty($data)) {
				$this->pixie->debug->pretty($data);
				$query = $this->conn->query('update')
					->table($this->table)
					->where($this->id_field, $this->id())
					->data($data)
					->execute();
			}
		}
		else {
			throw new \Exception("You called 'save_fields()' on a non-loaded object");
		}
		return $this;
	}

	/**
	 * Batch updates item columns using an associative array
	 *
	 * @param array $row        Associative array of key => value pairs
	 * @param boolean $set_loaded Flag to consider the ORM item loaded. Useful if you selected
	 *                            the row from the database and want to wrap it in ORM
	 * @return \PHPixie\ORM\Model Returns self
	 */
	public function values($row, $set_loaded=false)
	{
		foreach ($row as $key => $val) {
			$this->$key = $val;
		}
		if ($set_loaded) {
			$this->_loaded = true;
		}
		return $this;
	}

	/**
	 * Copy all values from another object
	 *
	 * @param array $other        The object to copy from (must be same class as this object)
	 * @return \PHPixie\ORM\Model Returns self
	 */
	public function copy_from($other) {
		$id = $this->id_field;
		if (is_subclass_of($other,'PHPixie\ORM\Model')) {
			if ($this->model_name !== $other->model_name) {
				throw new \Exception("Error - {$this->model_name}::copy_from() - the other object is a {$other->model_name}");
			}
			$row = $other->_row;
			if (isset($row[$id])) {
				unset($row[$id]);		// Don't copy the ID field
			}
			$this->values($row);
		}
		else {
			if (isset($other->$id)) {
				unset($other->$id);		// Don't copy the ID field
			}
			$this->values($other);
		}
	}
}
