<?php
use axion\data;

class Blog {
	
	function __construct(){}

	private function create_post(){

	}
	


	private function get_by_id($blog_id){
		$db = new data\PDO_DB();

		$ary_blog = $db->query('blog/get_by_id.sql')
			->bind(array(':blog_id'=>$blog_id))
			->execute()
			->fetch();

		$db->close();
		return $ary_blog;
	}

	private function get_all($limit=50){
		$db = new data\PDO_DB();

		$ary_blog = $db->query('blog/get_all.sql')
			->bind(array(':limit'=>$limit))
			->execute()
			->fetch();

		$db->close();
		return $ary_blog;
	}

	private function delete($blog_id){
		$db = new data\PDO_DB();

		$affected = $db->query('blog/delete.sql')
			->bind(array(':blog_id'=>$blog_id))
			->execute()
			->fetch();

		$db->close();
		return $affected;
	}
}

?>