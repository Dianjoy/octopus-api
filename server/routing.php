<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 16/8/24
 * Time: 上午12:03
 */

if (preg_match('/\.(?:png|jpg|jpeg|gif|html|hbs|md)$/', $_SERVER['REQUEST_URI'])) {
  return false;
} else {
  include __DIR__ . '/index.php';
}