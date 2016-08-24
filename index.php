<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 16/8/24
 * Time: 下午11:58
 */

use Octopus\router\Router;

require 'vendor/autoload.php';

$router = new Router(__DIR__);
$router->start();