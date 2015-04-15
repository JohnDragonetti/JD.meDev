<?php
error_reporting(E_ALL);

// WH Test database settings
define('DB_NAME', 'test');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', '127.0.0.1');

define('DIR_BASE', dirname(dirname(dirname(__FILE__))).'/');
define('DIR_APP', DIR_BASE.'app');
define('DIR_CLASS', DIR_APP.'/class/');
define('DIR_LIB', DIR_BASE.'lib/');
define('DIR_SQL', './sql/');
define('BASE_URL', 'http://localhost/JD.meDev/');
define('SUB_DIR', '/JD.meDev/');

define('LOADED', true);

// WH This is a general settings array. Some of our classes currently depend on this
// but I plan on re-writing them to correct this.
// $settings['sub_dir'] = '/JD.meDev/';
$settings['js'][] = 'main.js';
$settings['main_nav'] = array('home', 'about me', 'testimonials','blog','portfolio');
