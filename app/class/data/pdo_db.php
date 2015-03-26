<?php 
namespace axion\data;

/**
 * class PDO_DB
 *
 *
 * Basic usage: 
 * $pdo = new data\PDO_DB();
 * 
 * $stuff = $pdo->query('SELECT * FROM `test` WHERE `flg_active` = :flg_active')
 * 	->bind(array(':flg_active'=>1))
 *  ->execute()
 *  ->fetch();
 *
 * 
 */
class PDO_DB {

	private $driver;

	private $pdo;
	private $stmt;

	/** 
	 * Construct 
	 *
	 * @param string $driver    Optional, overrides $driver property
	 * 
	 */
	function __construct($driver=null){

		$this->driver = is_null($driver) ? 'mysql' : $driver;

		$dsn = $this->driver.':dbname='.DB_NAME.';host='.DB_HOST;
		$user = DB_USER;
		$pass = DB_PASS;

		$this->pdo = new \PDO($dsn, $user, $pass);
	}


    /**
     * @param string $sql
     * @return $this
     */
	public function query($sql){
		$this->stmt = $this->pdo->prepare($sql);
		return $this;
	}

    /**
     * @param array $ary_params
     * @return $this
     */
	public function bind($ary_params){

		foreach ($ary_params as $key => &$val) {
		    $this->stmt->bindParam($key, $val);
		}

		return $this;
	}

	public function execute(){
		$this->stmt->execute();
		return $this;
	}

	public function fetch(){
		return $this->stmt->fetchAll();
	}


	public function close(){
		$this->pdo = null;
	}


	public function test(){
		echo '<pre>';
		var_dump($this->pdo);
		echo '</pre>';
	}

	
}


?>