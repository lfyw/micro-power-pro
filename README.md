# 开发规范

## 项目规范
### 开发环境
#### <a id="software-version">软件版本</a>

|  软件   | 版本  | 说明 |
|  ----  | ----  | ---- |
| php  | 8.1 | 涉及到 php8.1 的枚举类等特性|
| redis  | 6.2.6 |开发版本|
| nginx | 1.20.2 | 开发版本|
| mysql| 8.0.27| 开发版本 |
| supervisor | 4.2.3 | 开发版本 |

#### 配置信息与环境变量

##### .env.example

因 .env 不会被纳入版本控制器中，所以本地 .env 里添加变量时 必须 同步到 .env.example 中，以免影响其他项目参与者的工作。

##### 存储位置

存储在 .env 和 config/app.php 文件中，然后使用 config() 函数来读取。

##### 辅助函数

统一放到 `app/helpers.php`中

## 编码规范
### <a id="catalog">目录结构</a>

为了提高代码可读性,降低维护难度,在尽量不增大工作量及提高复杂度的情况下,对**控制器**,**路由文件**,**模型**等做了目录分割.开发时**应该**严格按照这些规则创建文件或目录.

```
--app                                       app主目录
----Console                                 命令行相关目录
----Exceptions                              异常处理目录
----Http                                    Http目录
------Controllers                           控制器
--------User                                模块名称
----------Auth                              模块功能名称
------------AuthController.php              具体的实现控制器
------Middleware                            中间件
------Requests                              表单验证
--------User                                对应控制器的模块
----------Auth                              对应控制器的功能
------------AuthRequest                     具体表单验证实现
----Models
----Providers
----Supports                                自定义的包或者辅助类存放位置
--bootstrap
--config
--database
--public
--resource
--routes
----custom                                  路由分割
------user.php                              按模块区分
--storage
--tests
--vendor

...                                         以下未作改变
```
### 代码风格

**必须**严格按照[PSR-1](https://www.php-fig.org/psr/psr-1/), [PSR-2](https://www.php-fig.org/psr/psr-2/)规范

### 路由

**必须**遵循 github 的 restful 路由风格.如:资源名称应当为复数,路由应该只有小写字母中间用-隔开

### 模型

* **必须**使用数据库迁移创建表
* **绝不**在模型中直接调用登录状态信息,**必须**将其作为参数传递
* 模型名称**必须**为单数
* 数据库字段命名**必须**为蛇形
* 数据填充文件名**必须**为「复数」，如：PhotosTableSeeder.php
* 数据库表迁移名字**必须**为「复数」，如：2014_08_08_234417_create_photos_table.php
* 数据库表名字**必须**为「复数」，多个单词情况下使用蛇形, 如：photos, my_photos

### 控制器

* 控制器名**必须**为单数
* 注释代码**必须**在调试后删掉,代码中**绝不**留存注释代码块或未使用代码块
* **必须**按照规范的[目录结构](#catalog)放置控制器

### 表单验证

* **必须**遵循资源路由命名方式进行命名
* **必须**按照规范的[目录结构](#catalog)放置表单
* 一个资源控制器**应该**只有一个对应的表单,内部通过其他方式对应到不同的方法中
  
### artisan

* **必须**有项目的命名空间



## 部署说明
### 部署环境

按照[软件版本](#software-version)正确部署服务器环境

### 部署代码
   
```
git clone git@github.com:lfyw/micro-power-pro.git
cd micro-power-pro
composer install
```


### 扩展包

| 包名  | 版本  | 说明  | 环境|
| ---- | ---- | ---- | ---- |
|  laravel/octane  | ^1.1  | 服务器 |  |
|  barryvdh/laravel-ide-helper | ^2.11 | ide助手 | dev |
|  doctrine/dbal | ^3.2 | orm助手 | dev |
