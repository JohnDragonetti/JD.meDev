<?php
error_reporting(E_ALL);

// WH Test database settings
define('DB_NAME', 'test');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', '127.0.0.1');

define('DIR_APP', dirname(dirname(__FILE__)));
define('DIR_CLASS', DIR_APP.'/class/');
define('DIR_SQL', './sql/');
define('BASE_URL', 'http://axi.onl/Axion/');
define('SUB_DIR', '/JD.meDev/');

define('LOADED', true);

// WH This is a general settings array. Some of our classes currently depend on this
// but I plan on re-writing them to correct this.
// $settings['sub_dir'] = '/JD.meDev/';
$settings['js'][] = 'main.js';
$settings['main_nav'][] = 'test';