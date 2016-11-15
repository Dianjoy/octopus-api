Octopus API
========

Octopus API 是一个面向 API 的 PHP 框架。它有以下几个设计原则或目标：

1. 提供简单易用的图形界面，可以方便快捷地创造 RESTful API。
2. 所有衍生代码和配置均可纳入版本库进行版本管理。
3. 包含丰富的接口和钩子，可以根据业务需要，任意拓展功能。
4. 可以方便的将开发的功能打包成插件，共其它项目使用（基于 composer)

###　系统需求

1. PHP 5.6+
    1. APCu 用来保存路由
2. MySQL 5.6+
3. 将所有请求重定向到入口 php
4. 工作目录的写权限

## 安装

强烈建议使用 [Composer](https://getcomposer.org/)，大部分功能都会以其为基础。

```json
{
    "require": {
        "dianjoy/octopus-api": "dev-master"
    }
}
```
    
在入口 php 中引用 Octopus 的自带路由

```php
require 'vendor/autoload.php';

use octopus\Router;

$router = new Router();
$router->start();
```

## 图形界面

图形界面是 Octopus 最重要的特色之一。开发它的目的有两点：

1. 提升 API 开发效率。
2. 能够不写代码来实现简易功能。

### 启动项目

可以使用 Apache 或者 Nginx 请配置重定向。或者直接使用 PHP 测试服务器启动服务：

```bash
php -S localhost:8888 vendor/dianjoy/octopus-api/server/routing.php
```

### 进行安装和配置

访问刚才的地址（如果使用别的方式启动服务，请打开相应的地址）。

您应该会看到如下图所示的界面，请按照向导提示进行服务器配置。

### 进行 API 配置

配置完服务器之后，Octopus 会自动进行数据库初始化，请稍等片刻。

如果一切正常，您会看到以下界面，这个时候您就可以设置 API 了。

如果您有任何问题，请往后看。如果没有办法解决，请直接开 issue。

## 文档

* [范例](./docs/sample.md)
* [入门](./docs/get-started.md)
* [自定义接口](./docs/custom-api)

### 使用插件

* [增加评论功能](./docs/plugin/comment.md)

### 开发技巧

* [接口数据验证](./doc/api/validate.md)
* [接口数据转换和预处理](./doc/api/data-convertor.md)
* [给接口设置权限](./doc/api/auth.md)
* [对整个项目进行版本管理](./doc/vcs.md)

## 测试

Octopus 的图形界面可以测试接口返回值。当然我也推荐您使用 [Postman](https://www.getpostman.com/)。

Octopus 的全部单元测试基于 [PHPUnit](https://phpunit.de/) ，位于 `docs/` 目录内。

--------

## TODO

1. 支持多数据库，包括主从。

--------

## 协议

[MIT](./LICENSE)