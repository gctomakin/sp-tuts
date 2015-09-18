<?php
class UsersDAO {

	private $db;

	function __construct(Database $db){

		$this->db = $db; // database instance injected to UsersDAO db variable
	}

	public function insert(UsersVO $user){
		$username = $user->getUsername();
		$password = $user->getPassword();
		$sql = 'INSERT INTO users(username,password) VALUES (:username, :password)';
		$stmt = $this->db->conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$result = $stmt->execute();

		if($result)

			return true;

		else

			return false;
		

	}

	public function display(){

		$sql = 'SELECT * FROM users';
		$stmt = $this->db->conn->prepare($sql);
		$stmt->execute();
		//$stmt->setFetchMode(PDO::FETCH_OBJ, "UsersVO");
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		return $result;

	}

	public function getCount(){

		$sql = 'SELECT * FROM users';
		$stmt = $this->db->conn->prepare($sql);
		$stmt->execute();
		//$stmt->setFetchMode(PDO::FETCH_OBJ, "UsersVO");
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		return sizeof($result);

	}

	public function long_pooling($ctr){

		while (true) {		   

			$last_counter = $ctr;
			$last_change_counter = $this->getCount();

			if ($last_counter == null || $last_change_counter > $last_counter) {

				if($last_change_counter == 0){

					sleep( 1 );
					continue;

				}else{

					$result = array('passcounter' => $last_change_counter);
					
					$json = json_encode($result);
					echo $json;		 
					break;

				}			        	

			} else {		

				sleep( 1 );
				continue;
				
			}

		}

	}



}

?>