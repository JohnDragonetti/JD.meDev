<?php
namespace axion\data;
use axion\data;

class Blog {
	

	function __construct(){}

    /**
     * Facilitates the creation of a blog post.
     *
     * @param object $request    Standard request object
     *
     * @return array
     */
	public function create($request){
		$params = $request->parameters;
		$title = $params['title'];
		$body = $params['body'];
		$category_id = $params['category_id'];

		$data = $this->create_post($title, $body, $category_id);

		$response = array('success'=>true, 'body'=>$data);

		return $response;
	}


    /**
     * Creates a record in the blog table in the database. Returns the id of the blog
     *
     * @param string $title       The title given to this blog post
     * @param string $body        The actual content of the blog post
     * @param int $category_id    The id of the corresponding category for this blog
     *
     * @return mixed
     */
	private function create_post($title, $body, $category_id){
		$db = new data\PDO_DB();

		$insert_id = $db->query('blog/get_by_id.sql')
			->bind(array(':title'=>$title, ':body'=>$body, ':category_id'=>$category_id))
			->execute()
			->insert_id();

		$db->close();
		return $insert_id;
	}


    /**
     * Retrieves a record in the blog table, based on the provided id
     *
     * @param int $blog_id    The blog_id of the blog we're retrieving
     *
     * @return mixed
     */
	private function get_by_id($blog_id){
		$db = new data\PDO_DB();

		$ary_blog = $db->query('blog/get_by_id.sql')
			->bind(array(':blog_id'=>$blog_id))
			->execute()
			->fetch();

		$db->close();
		return $ary_blog;
	}

    /**
     * Returns all records in the blog table.
     *
     * @param int $limit    The number of rows to return. Defaults to 50
     *
     * @return mixed
     */
	private function get_all($limit=50){
		$db = new data\PDO_DB();

		$ary_blog = $db->query('blog/get_all.sql')
			->bind(array(':limit'=>$limit))
			->execute()
			->fetch();

		$db->close();
		return $ary_blog;
	}

    /**
     * Deletes a record in the blog table corresponding to the provided $blog_id
     *
     * @param int $blog_id
     *
     *
     * @return mixed
     */
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