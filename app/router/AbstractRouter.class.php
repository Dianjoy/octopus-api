<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 16/8/25
 * Time: 下午11:42
 */

namespace Octopus\router;


class AbstractRouter {

  static protected $dir;

  public function __construct( $dir ) {
    self::$dir = $dir;
  }

  public function route( $route, $method ) {

  }
}