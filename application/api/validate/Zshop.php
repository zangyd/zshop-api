<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    Api基类验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/3/23
 */

namespace app\api\validate;

use think\Validate;

class Zshop extends Validate
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'appkey'     => 'integer|length:8',
        'token'      => 'max:100',
        'sign'       => 'min:32',
        'timestamp'  => 'checkTimestamp',
        'format'     => 'in:json,jsonp,xml',
        'version'    => 'max:10',
        'controller' => 'max:20',
        'method'     => 'max:100',
        'callback'   => 'max:255', // jsonp的返回方法
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'batch' => [
            'version'    => 'require',
            'controller' => 'require',
            'method'     => 'require',
        ],
    ];

    /**
     * 验证时间戳是否在允许范围内
     * @access protected
     * @param  int $value 验证数据
     * @return string|true
     */
    protected function checkTimestamp($value)
    {
        $timestamp = strtotime($value);
        if (false === $timestamp) {
            $timestamp = $value;
        }

        if ($timestamp > strtotime("+10 minute") || $timestamp < strtotime("-10 minute")) {
            return 'timestamp已过期';
        }

        return true;
    }
}
