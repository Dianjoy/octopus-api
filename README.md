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

## 建立数据结构

接下来创建数据结构。这里假设我们要建立一个类 Wordpress 的博客网站。首先分析需求：

1. 博客网站自然需要发表和展示文章
2. 作者需要登录才能发表文章
3. 每篇文章都有不同的属性，比如：
    1. 标题
    2. 正文
    3. 作者
    4. 创建时间
    5. 标签

这里只为举例，所以不用列那么全，上面这些都很有代表性。第一项很明显不用管；第二项作为基础服务 Octopus 自带；我们只需要处理第三项。接下来，创建第一个表，`article`，结构如下：

| 字段 | 类型 | 说明 |
| ---- | ---- | ---- |
| id | int | 文章id |
| title | varchar(100) | 标题 |
| author | smallint | 作者id |
| create_time | datetime | 创建时间 |
| tags | tinyint | tag id |
| status | tinyint | 状态 |

表结构可以随时调整，所以也不必太去深究（正在运行的服务贸然调整数据库结构可能导致严重后果，此文章只为介绍框架，某些内容不能作为示范，相信大家可以自行分辨）。点击 `author` 字段后面的“关联”按钮，选中 `user` 表的 `id`，这样文章作者就和用户关联起来了。

接下来建立第二个表，`tag`，结构如下：

| 字段 | 类型 | 说明 |
| ---- | ---- | ---- |
| id | int | 标签id |
| tag | varchar(100) | 标签 |
| alias | varchar(100) | 标签别名，用来作为英文目录 |
| status | tinyint| 状态 |

回到刚才的 `article` 表，点击 `tags` 字段后面的“关联”按钮，选中 `tag` 表中的 `id`，注意，这次需要勾选“多对多”，因为一篇文章可以有多个标签。

以上建表的过程可以使用任何熟悉的工具完成，只要使用 Octopus 建立关联即可。

## 配置API

现在盘点一下我们需要的API：

1. 登录/注册（已实现）
2. 创建文章
3. 读取文章，包括按照各种方式筛选排序

熟悉 RESTful 的人到这里应该已经明白了。接下来我们开始实操。

创建接口 `/artcile`，方法选择 `post`，操作选择“创建”，然后选择 `article` 表。对应的字段自然会到对应的字段去，这点不用担心。

再次创建接口 `/article`，方法选择 `get`，操作选择“读取”。选择 `article` 表，勾选您希望输出的字段。然后您可以继续定义筛选的字段和排序的字段，并且设置每页的数量，这些在 UI 上展现都很明确，就不一一说明了。

### 高级技巧

* [接口数据验证](./doc/api/validate.md)
* [接口数据转换和预处理](./doc/api/data-convertor.md)
* [给接口设置权限](./doc/api/auth.md)

## 自定义处理函数

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
        
        // 返回结果
        return $result;
        
        // 也可以直接输出结果，这将忽略后续操作，比如数据格式化，直接退出
        $this->output($result);
      }  
    }     
    
默认情况下，Octopus 会在定制接口处理完成之后，再调用我们的自定义接口。这里可以通过 `post` 方法（其它方法也一样）的第四个参数 `options['order']` 来调整。函数的处理结果会返回框架继续处理，比如对数据进行格式化。您也可以直接输出。

### 相关文档

[自定义接口](./doc/custom-api.md)

## 测试

只是测试接口效果推荐使用 [Postman](https://www.getpostman.com/)。

Octopus 支持的 [PHPUnit](https://phpunit.de/) 单元测试。

--------

## 协议

[MIT](./LICENSE)