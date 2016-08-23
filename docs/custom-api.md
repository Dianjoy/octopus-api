扩展接口功能
========

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