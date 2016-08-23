# Octopus API

Octopus，基于 PHP 的 API 快速搭建工具。提供简单易学的图形界面，可以方便快捷地创造 RESTful API。如果标准功能无法满足需求，也可以很容易地自行拓展，并且还能延续正常的开发流程，使用熟悉的IDE，并且把所有产出都纳入版本库。

## 安装

使用 [Composer](https://getcomposer.org/)

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

###　系统需求

1. PHP 5.6+
2. MySQL 5.6+
3. 将所有请求重定向到入口 php
4. 对工作目录的写权限

## 图形界面

Octopus 最大的特色就是图形界面。我相信图形界面会极大的提高 API 开发效率。

### 启动项目

这里使用 Apache 或者 Nginx 请配置重定向。或者直接使用 PHP 内建服务器进行尝试：

```bash
php -S localhost:8888 vendor/dianjoy/octopus-api/routing.php
```

### 进行安装和配置

访问刚才的地址（如果使用别的方式启动服务，请打开相应的地址）。

您应该会看到如下图所示的界面，请按照向导提示进行服务器配置。

Octopus 支持多数据库，包括主从。生成的数据库连接位于 `vendor/pdo_{name}.php`，可以手工修改。**请勿提交到版本库!**

## 文档

* [范例](./docs/sample.md)
* [入门](./docs/get-started.md)
* [自定义接口](./docs/custom-api)

### 高级技巧

* [接口数据验证](./doc/api/validate.md)
* [接口数据转换和预处理](./doc/api/data-convertor.md)
* [给接口设置权限](./doc/api/auth.md)

## 测试

Octopus 的图形界面可以测试接口返回值。当然我也推荐您使用 [Postman](https://www.getpostman.com/)。

Octopus 的全部单元测试基于 [PHPUnit](https://phpunit.de/) ，位于 `docs/` 目录内。

--------

## 协议

[MIT](./LICENSE)