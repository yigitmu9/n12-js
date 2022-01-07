<?php

require_once("constants.php");

class DatabaseException extends Exception {}

class DatabaseConnection  extends mysqli 
{
	protected	$_host = DB_HOST_ADDRESS;
	protected	$_username = DB_USER_NAME;
	protected	$_password = DB_USER_PASSWORD;
	protected	$_primary_db = DB_NAME;
	
	public function __construct()
	{
		parent::__construct($this->_host, $this->_username, $this->_password, $this->_primary_db);
		parent::set_charset('UTF8');
		//parent::query("SET NAMES UTF8");
		if ($this->connect_error) {
			throw new DatabaseException(sprintf('(%s) %s', $this->connect_errno, $this->connect_error));
		}
	}

	public function __destruct()
	{
		parent::close();
	}

	public function select_primary_db()
	{
		return $this->select_db($this->_primary_db);
	}
	
}

class DatabaseModelBase
{
    protected $connection;

    public function __construct(DatabaseConnection  $connection) {
        $this->connection = $connection;
    }

    protected function prepare($query) {
        $connection = $this->connection;
        $statement = $connection->prepare($query);
        if (!$statement) {
            throw new DatabaseException(sprintf('(%s) %s', $connection->error, $connection->errno));
        }
        return $statement;
    }
}



?>