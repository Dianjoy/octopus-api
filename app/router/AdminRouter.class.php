<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 16/8/25
 * Time: 下午11:28
 */

namespace Octopus\router;


class AdminRouter extends AbstractRouter {

  const Routes = [

  ];

  public function init(  ) {
    foreach ( self::Routes as $route => $pair ) {
      foreach ( $pair as $method => $callback ) {
        $this->route($route, $method, $callback);
      }
    }
  }
}