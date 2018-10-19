<?php

/**
 * MVC OOP App by Hagai-Avisar */

require_once('Settings.php');
require_once('controller/DB.php');

/** Autoloads */
require_once('vendor/autoload.php');
require_once('model/autoload.php');
require_once('controller/autoload.php');
/* EOF Autoloads */

require_once('controller/Route.php');

use \System\Route\RouteController as route;
$route = new route;

require_once('view/view.php');