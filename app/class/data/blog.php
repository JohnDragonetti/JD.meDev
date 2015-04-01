<?php
use axion\data;

class Blog {
	

	function __construct(){}

	public function create($request){
		$params = $request->parameters;
		$title = $params['title'];
		$body = $params['body'];
		$category_id = $params['category_id'];

		$data = $this->create_post($title, $body, $category_id);

		$response = array('success'=>true, 'body'=>$data);

		return $response;
	}


	private function create_post($title, $body, $category_id){
		$db = new data\PDO_DB();

		$insert_id = $db->query('blog/get_by_id.sql')
			->bind(array(':title'=>$title, ':body'=>$body, ':category_id'=>$category_id))
			->execute()
			->insert_id();

		$db->close();
		return $insert_id;
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