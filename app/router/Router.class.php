<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 16/8/24
 * Time: 下午11:57
 */

namespace Octopus\router;


class Router extends AbstractRouter {

  static $adminRouter = null;

  public function __construct( $dir ) {
    parent::__construct($dir);

    self::createAdminRoutes();
  }

  public function start() {

  }

  private static function createAdminRoutes() {
    if (self::$adminRouter) {
      return;
    }

    self::$adminRouter = new AdminRouter(self::$dir);
    self::$adminRouter->init();
  }
}