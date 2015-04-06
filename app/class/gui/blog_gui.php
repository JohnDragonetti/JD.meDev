<?php
namespace axion\gui;
use axion\gui;
use axion\data;

class Blog_gui extends data\Blog {
	
	function __construct(){}

	public function show_post($post_id){}

	public function show_summary(){}



	public function show_all(){
        // WH Normally we'd fetch X number of posts from the DB and loop over them here, but we don't have the DB in place
        $blog = array(
            array('title'=>'First Post', 'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda atque beatae, commodi deserunt dicta eos error ex expedita fugiat minima necessitatibus quaerat voluptate voluptatum. Ab beatae dignissimos perferendis rem vel!'),
            array('title'=>'Fasdfst', 'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda atque beatae, commodi deserunt dicta eos error ex expedita fugiat minima necessitatibus quaerat voluptate voluptatum. Ab beatae dignissimos perferendis rem vel!'),
            array('title'=>'First Post', 'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda atque beatae, commodi deserunt dicta eos error ex expedita fugiat minima necessitatibus quaerat voluptate voluptatum. Ab beatae dignissimos perferendis rem vel!'),
            array('title'=>'Ffghjfghjst', 'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda atque beatae, commodi deserunt dicta eos error ex expedita fugiat minima necessitatibus quaerat voluptate voluptatum. Ab beatae dignissimos perferendis rem vel!'),
            array('title'=>'lhgjkghjkost', 'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda atque beatae, commodi deserunt dicta eos error ex expedita fugiat minima necessitatibus quaerat voluptate voluptatum. Ab beatae dignissimos perferendis rem vel!'),
            array('title'=>'Tutorial: #323', 'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda atque beatae, commodi deserunt dicta eos error ex expedita fugiat minima necessitatibus quaerat voluptate voluptatum. Ab beatae dignissimos perferendis rem vel!'),
            array('title'=>'Tutorial: #23452', 'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda atque beatae, commodi deserunt dicta eos error ex expedita fugiat minima necessitatibus quaerat voluptate voluptatum. Ab beatae dignissimos perferendis rem vel!'),
            array('title'=>'A post', 'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda atque beatae, commodi deserunt dicta eos error ex expedita fugiat minima necessitatibus quaerat voluptate voluptatum. Ab beatae dignissimos perferendis rem vel!'),
            array('title'=>'Post!', 'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda atque beatae, commodi deserunt dicta eos error ex expedita fugiat minima necessitatibus quaerat voluptate voluptatum. Ab beatae dignissimos perferendis rem vel!'),
        );

        $body = '';
        foreach($blog as $post ){
            $body .= $this->build_summary($post);
        }


        return $body;
    }


    /**
     * @param $ary_post
     *
     * @return $summary
     */
    private function build_summary($ary_post){

        $summary = '<div class="post-summary">';
        $summary .= '<div class="summary-title">'.$ary_post['title'].'</div>';
        $summary .= '<div class="summary-body">'.$ary_post['body'].'</div>';
        $summary .= '<div class="pull-right summary-read-more"><a href="#">Read more</a></div>';
        $summary .= '</div>';

        return $summary;
    }
}


?>