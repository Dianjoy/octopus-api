<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 16/8/25
 * Time: 下午11:42
 */

namespace Meathill\Octopus\router;

/**
 * Class AbstractRouter
 *
 * @package Meathill\Octopus\router
 *
 * @method GET(string $route, Callable $callback)
 */
class AbstractRouter {

  static protected $map = [];
  static protected $dir;

  protected $group;

  public function __construct( $dir ) {
    self::$dir = $dir;
  }

  public function __call( $method, array $params ) {
    list($uri, $callback) = $params;
    $uri = dirname($_SERVER['PHP_SELF']) . '/' . $uri;

    $this->route($uri, $method, $callback);
  }

  public function group( $group ) {
    $this->group = $group;
    return $this;
  }

  public function route( $route, $method, $callback ) {
    self::$map[$this->group . $route][$method][] = $callback;
  }
}