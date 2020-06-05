<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    订单日志验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/8/14
 */

namespace app\common\validate;

class OrderLog extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'order_id'        => 'require|integer|gt:0',
        'order_no'        => 'require|max:50',
        'trade_status'    => 'require|integer|egt:0',
        'delivery_status' => 'require|integer|egt:0',
        'payment_status'  => 'require|integer|egt:0',
        'comment'         => 'require|max:200',
        'description'     => 'require|max:100',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'order_id'        => '订单编号',
        'order_no'        => '订单号',
        'trade_status'    => '订单交易状态',
        'delivery_status' => '订单配送状态',
        'payment_status'  => '订单支付状态',
        'comment'         => '订单日志备注',
        'description'     => '订单日志描述',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'log' => [
            'order_no',
        ],
    ];
}
