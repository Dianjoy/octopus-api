<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 16/8/24
 * Time: 下午11:57
 */

namespace Octopus\router;


class Router {

  protected $dir;

  public function __construct( $dir ) {

    $this->dir = $dir;
  }

  public function start() {

  }
}