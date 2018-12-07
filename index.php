<?php 

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


// !bisa juga dengan menggunakan autoload psr4 yang telah disediakan composer
// 1. lakukan composer update pada directory
// 2. Buang tanda komentar di dibaris bawah no 2
// require './vendor/autoload.php';




//jika menggunakan autoload psr4 dari composer komentar dari sini sampai spl_autoload_register('autoload_classes');

define("PROJECTPATH", dirname(__DIR__) . '/Custom-MVC-Php');

function autoload_classes($class_name)
{
	$filename = PROJECTPATH . '/' . str_replace('\\', '/', $class_name) .'.php';

	if(is_file($filename))
	{
		include_once $filename;
	}
}

spl_autoload_register('autoload_classes');

//sampai sini


require 'config.php';

use App\Core\Core;

$core = new App\Core\Core();
$core -> run();	