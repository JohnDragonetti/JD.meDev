<?php
require_once 'app/config/common.php';
/**
 * 
 */
use axion\data;

var_dump(isset($_SERVER['PATH_INFO']));

$request = new data\Request();

var_dump($request);



?>