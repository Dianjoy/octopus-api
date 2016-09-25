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
 * @method POST(string $route, Callable $callback)
 * @method PUT(string $route, Callable $callback)
 * @method DELETE(string $route, Callable $callback)
 * @method OPTIONS(string $route, Callable $callback)
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

  public function navigate( $method, $uri ) {
    self::_navigate($method, $uri);
  }

  public function route( $route, $method, $callback ) {
    self::$map[$this->group . $route][$method][] = $callback;
  }

  public function start(  ) {
    self::_start();
  }

  public static function _start() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    self::navigate($method, $uri);
  }

  public static function _navigate( $method, $uri ) {
    $method = strtoupper($method);
  }
}