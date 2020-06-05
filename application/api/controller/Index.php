<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    Api控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/03/23
 */

namespace app\api\controller;

class Index
{
    public function index()
    {
        return ['status' => 200, 'data' => '欢迎使用Zshop商城框架系统 - Api'];
    }
}
