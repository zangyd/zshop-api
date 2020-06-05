<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    应用入口文件
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/24
 */
// PHP版本检查
if (version_compare(PHP_VERSION, '5.6', '<')) {
    header("Content-type: text/html; charset=utf-8");
    die('PHP版本过低，最少需要PHP5.6，请升级PHP版本！');
}

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

// 加载全局配置宏定义
require __DIR__ . '/config.php';

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
