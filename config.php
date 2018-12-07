<?php 

global $config;
$config = array();

define("BASE","http://localhost/Custom-MVC-Php");
define("BASEADMIN", BASE. "admin");
define("BASEDIR", __DIR__ . '/');


$config['dbname']= 'lks';
$config['host']= 'localhost';
$config['password']= 'root';
$config['dbuser']= 'root';

