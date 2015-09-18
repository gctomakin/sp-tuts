<?php 
class Database{

	public $conn; // instance variable
	private $dbhost = 'localhost';
	private $dbname = 'spspsp';
	private $username = 'root';
	private $password = '';
	private static $instance;
	
	function __construct(){

		try{

			$this->conn = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname}",$this->username,$this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}catch(PDOException $e){

			throw new Exception($e->getMessage());

		}

	}

	//singleton pattern (create only one instance)
	public static function getInstance(){

		if(!isset(self::$instance)){

			$object = __CLASS__;
			self::$instance = new $object;
		}

		return self::$instance;
	}


}
?>