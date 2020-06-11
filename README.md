### 借助php phar打包功能实现

1.php配置

```code
    1.打包类库需要开启php.ini
      vim php.ini
    2.修改配置
      phar.readonly = Off
      phar.require_hash = On
    3.重启php-fpm  
      service php-fpm restart

```


2.需要注意的问题

```
类库一样的路径情况
        公用类库:
           \App\Sdks\Services\TestService

        本地类库
        \App\Sdks\Services\TestService

        调用类库
        \App\Sdks\Services\TestService

        加载文件根据命名空间注册顺序
```


3.具体使用步骤

```
    1.第一步打包项目
        在项目根目录执行 php build.php
        会在/data/web/phar目录生成ztjy_composer.phar文件
    2.需要用到的项目引入phar文件
        require '/data/phar/ztjy_composer.phar';
    3.使用包文件即可
```

4.phar包使用注意事项
```
1.phar文件不能过大  单个文件不建议超过1M   
因为php-fpm每次需要从磁盘加载一个大文件,高并发下依赖磁盘IO,对CPU消耗大
会出现CPU监控插针的现象
所以,不建议用来打包composer vendor目录里的内容

2.可用来打包 常量类 和工具类[数组/字符串/时间处理等]

```