<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    Api独立配置文件
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/03/22
 */

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用Trace
    'app_trace'           => false,
    // 默认输出类型
    'default_return_type' => 'json',
    // API调试模式
    'api_debug'           => false,
    // API请求结果为空时返回内容
    'empty_result'        => null,

    // +----------------------------------------------------------------------
    // | 异常及错误设置
    // +----------------------------------------------------------------------

    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'    => 'app\api\exception\ApiException',
];
