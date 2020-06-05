#!/usr/bin/env php
<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    命令行入口文件
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/5/4
 */

// 定义项目路径
define('APP_PATH', __DIR__ . '/application/');

// 加载全局配置宏定义
require __DIR__ . '/public/config.php';

// 加载框架引导文件
require __DIR__ . '/thinkphp/console.php';
