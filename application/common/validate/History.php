<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    我的足迹验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/7/15
 */

namespace app\common\validate;

class History extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'history_id'  => 'integer|gt:0',
        'goods_id'    => 'require|integer|gt:0',
        'page_no'     => 'integer|gt:0',
        'page_size'   => 'integer|gt:0',
        'order_type'  => 'in:asc,desc',
        'order_field' => 'in:history_id,goods_id,update_time',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'history_id'  => '我的足迹编号',
        'goods_id'    => '商品编号',
        'page_no'     => '页码',
        'page_size'   => '每页数量',
        'order_type'  => '排序方式',
        'order_field' => '排序字段',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'del'  => [
            'history_id' => 'require|arrayHasOnlyInts',
        ],
        'list' => [
            'page_no',
            'page_size',
            'order_type',
            'order_field',
        ],
    ];
}
