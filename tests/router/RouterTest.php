<?php
/**
 * Created by PhpStorm.
 * User: meathill
 * Date: 16/8/30
 * Time: 下午11:22
 */

namespace Test\router;


use Meathill\Octopus\router\Router;
use PHPUnit_Framework_TestCase;

class RouterTest extends PHPUnit_Framework_TestCase {

  public function testRouter(  ) {
    $router = new Router(__DIR__);
    $router->GET('user', [$this, 'onGET_user']);
  }

  // 测试 GET /user 请求
  public function onGet_user() {

  }

  // 测试 GET /user/:id 请求

  // 测试 PUT /user/:id/ 请求

  // 测试 GET /user/(\d+) 请求
}