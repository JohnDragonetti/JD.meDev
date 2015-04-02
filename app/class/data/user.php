<?php 
namespace axion\data;

class User{

	function __construct (){

	}


	public function authenticate($user, $password){
		// WH attempt to get user by username first, then, if necessary, by user_id
		$this->get_by_username($user);
	}


	public function salt(){
		//WH TODO Integrate password_hash()
	}

	/**
	 * Retrieves a row from the user table associated with the provided $user_id 
	 * @param  int $user_id [description]
	 * @return array          [description]
	 */
	private function get_by_id($user_id){
		$db = new data\PDO_DB();

		$ary_user = $db->query('user/get_by_id.sql')
			->bind(array(':user_id'=>$user_id))
			->execute()
			->fetch();

		$db->close();
		return $ary_user;
	}

	/**
	 * Retrieves a row from the user table associated with the provided $user_id
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	private function get_by_username($username){
		$db = new data\PDO_DB();

		$ary_user = $db->query('user/get_by_username.sql')
			->bind(array(':user_id'=>$username))
			->execute()
			->fetch();

		$db->close();
		return $ary_user;
	}


}

?>