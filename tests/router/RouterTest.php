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

  protected $id;
  protected $get;
  protected $posted;
  protected $put;
  protected $putID;
  protected $deleted;
  protected $deleteID;

  public function testRouter(  ) {
    $router = new Router(__DIR__);
    $router->GET('user', [$this, 'onGET_user']);
    $router->GET('user/:id', [$this, 'onGET_userID']);
    $router->POST('user/', [$this, 'onPOST_user']);
    $router->PUT('user/:id', [$this, 'onPUT_user']);
    $router->DELETE('user/:id', [$this, 'onDELETE_user']);

    $this->assertTrue($this->get);
    $this->assertEquals(1, $this->id);
    $this->assertTrue($this->posted);
    $this->assertTrue($this->put);
    $this->assertEquals(123, $this->putID);
    $this->assertTrue($this->deleted);
    $this->assertEquals(1234, $this->deleteID);


    $router->GET('user/(\d+)', [$this, 'onGET_userID']);
    $this->assertNotEquals('abc', $this->id);
    $router->GET('user/([\w_]+)', [$this, 'onGET_userID']);
    $this->assertEquals('abc', $this->id);
  }

  // 测试 GET /user 请求
  public function onGet_user() {
    $this->get = true;
  }

  // 测试 GET /user/:id 请求
  public function onGET_userID( $id ) {
    $this->id = $id;
  }
  
  // 测试 POST /user/ 请求
  public function onPOST_user(  ) {
    $this->posted = true;
  }

  // 测试 PUT /user/:id/ 请求
  public function onPUT_user( $id ) {
    $this->put = true;
    $this->putID = $id;
  }

  // 测试 DELETE
  public function onDELETE_user( $id ) {
    $this->deleted = true;
    $this->deleteID = $id;
  }
}