<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    路由配置文件
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/03/22
 */

use think\Route;

Route::group(ADMIN_MODULE, function () {
    Route::rule('/', 'admin/index/index');
});

Route::group('admin', function () {
    Route::rule('/', 'index/index/index');
});

Route::rule('api/:version/:controller', 'api/:version.:controller/index');
