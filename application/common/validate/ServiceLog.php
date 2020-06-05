<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    售后日志验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/10/13
 */

namespace app\common\validate;

class ServiceLog extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'order_service_id' => 'require|integer|gt:0',
        'service_no'       => 'require|max:50',
        'comment'          => 'require|max:255',
        'description'      => 'require|max:100',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'order_service_id' => '售后服务编号',
        'service_no'       => '售后单号',
        'comment'          => '售后服务备注',
        'description'      => '售后服务描述',
    ];
}
