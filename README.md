# octopus-api

八爪鱼，基于PHP的API快速搭建工具。

## 安装

使用 [Composer](https://getcomposer.org/)

    {
      "require": "dianjoy/octopus-api"
    }
    
在入口 php 中引用 octopus 的自带路由

    require 'vendor/autoload.php';
    
    use octopus\Router;
    
    $router = new Router();
    
好，现在请通过浏览器访问项目，进行配置。

## 配置路由

第一步配置完数据库之后，即可开始进行路由配置。

## 自定义路由处理

除了使用工具配置路由处理函数以外，octopus 最强大的地方便是非常简单自定义路由处理。