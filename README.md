# Octopus API

Octopus，基于PHP的API快速搭建工具。提供简单易学的图形界面，可以方便快捷地创造 RESTful API。如果标准功能无法满足需求，也可以很容易地自行拓展，并且还能延续正常的开发流程，使用熟悉的IDE，并且把所有产出都纳入版本库。

## 安装

使用 [Composer](https://getcomposer.org/)

    {
      "require": "dianjoy/octopus-api"
    }
    
在入口 php 中引用 Octopus 的自带路由

    require 'vendor/autoload.php';
    
    use octopus\Router;
    
    $router = new Router();
    
现在，使用浏览器访问该页面，进行安装。

### 重定向

RESTful 接口需要将所有请求重定向到入口 php，请注意启用。

## 配置数据库

填写表单，配置数据库连接。Octopus 支持多数据库，包括主从。生成的数据库连接位于 `vendor/pdo_{name}.php`，可以手工修改。**请勿提交到版本库!**

## 配置路由

接下来可以创建接口。这里假设我们要建立一个类 Wordpress 的博客网站，该怎么弄呢？

首先分析需求，博客网站自然需要发表和展示文章，作者需要登录才能发表文章。每篇文章都有不同的属性，比如：

1. 标题
2. 正文
3. 作者
4. 创建时间
5. 标签

这里只为举例，所以不用列的太多，上面这些都很有代表性。我们创建第一个表，`t_article`，结构如下：

| 字段 | 类型 | 说明 |
| ---- | ---- | ---- |
| id | int | 文章id |
| title | varchar(100) | 标题 |
| author | smallint | 作者id |
| create_time | datetime | 创建时间 |
| status | tinyint | 状态 |

结构可以随时调整，所以也不必太去深究（正在运行的服务贸然调整数据库结构可能导致严重后果，此文章只为介绍框架，某些部分不作示范，相信大家可以自行分辨）。



## 自定义路由处理

除了使用可视化工具配置简单的 CURD 以外，Octopus 最强大的地方便是自定义处理。接下来我们继续前面的例子，准备增加一个功能，即发表文章后自动邮件通知订阅用户。

这里只需要做两件事：

1. 定义一个 `Controller`，继承 `Octopus\AbstractController`，包含一个方法处理请求
2. 声明路由，使用刚才创建的方法

index.php

    $router->post('/article/', MyController, 'onPost_pathTo');
    
MyController.class.php

    class MyController extends AbstractController {
      public function onPost_pathTo () {
        // 访问提交的内容，根据提交的类型判断，通常是 JSON 或者字符串
        $this->request->body;
        
        // 当前用户信息
        $this->request->user;
        
        // 定制接口的处理结果
        $this->result;
        
        // 调用定制接口并得到结果
        $result = $this->just_do_it();
      }  
    }     
    
默认情况下，Octopus 会在定制接口处理完成之后，再调用我们的自定义接口。这里可以通过 `post` 方法（其它方法也一样）的第四个参数 `options['is_append']` 来调整。 

### 相关文档

[自定义接口](./wiki/custom-api)

## 测试

只是测试接口效果推荐使用 [Postman](https://www.getpostman.com/)。

Octopus 支持的 [PHPUnit](https://phpunit.de/) 单元测试。

--------

## 协议

[MIT](./LICENSE)