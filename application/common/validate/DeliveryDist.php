<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    配送轨迹验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/27
 */

namespace app\common\validate;

class DeliveryDist extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'client_id'        => 'require|integer|gt:0',
        'order_code'       => 'require|max:50',/*|unique:delivery_dist'*/
        'delivery_id'      => 'integer|egt:0',
        'delivery_item_id' => 'integer|egt:0',
        'delivery_code'    => 'max:30',
        'logistic_code'    => 'require|max:50',
        'exclude_code'     => 'arrayHasOnlyStrings',
        'is_trace'         => 'in:0,1',
        'state'            => 'in:0,1,2,3,4,201',
        'is_sub'           => 'in:0,1',
        'account'          => 'max:80',
        'timeout'          => 'integer|egt:0',
        'page_no'          => 'integer|gt:0',
        'page_size'        => 'integer|gt:0',
        'order_type'       => 'in:asc,desc',
        'order_field'      => 'in:delivery_dist_id,order_code,delivery_item_id,logistic_code,state,is_sub',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'client_id'        => '账号编号',
        'order_code'       => '流水号',
        'delivery_id'      => '配送方式编号',
        'delivery_item_id' => '快递公司编号',
        'delivery_code'    => '快递公司编码',
        'logistic_code'    => '快递单号',
        'exclude_code'     => '排除快递单号',
        'is_trace'         => '是否获取配送轨迹',
        'state'            => '配送状态',
        'is_sub'           => '是否订阅推送',
        'account'          => '账号或昵称',
        'timeout'          => '超时配送',
        'page_no'          => '页码',
        'page_size'        => '每页数量',
        'order_type'       => '排序方式',
        'order_field'      => '排序字段',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'item'  => [
            'order_code'    => 'require|max:50',
            'logistic_code' => 'max:50',
            'exclude_code',
        ],
        'list'  => [
            'order_code'    => 'max:50',
            'logistic_code' => 'max:50',
            'is_trace',
            'state',
            'is_sub',
            'account',
            'timeout',
            'page_no',
            'page_size',
            'order_type',
            'order_field',
        ],
        'trace' => [
            'delivery_code' => 'require|max:30',
            'logistic_code',
        ],
    ];
}
