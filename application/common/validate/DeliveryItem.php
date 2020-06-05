<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    快递公司验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/25
 */

namespace app\common\validate;

class DeliveryItem extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'delivery_item_id' => 'integer|gt:0',
        'name'             => 'require|max:50',
        'phonetic'         => 'max:10',
        'code'             => 'require|max:30',
        'type'             => 'require|integer|between:0,3',
        'exclude_id'       => 'integer|gt:0',
        'company_all'      => 'in:0,1',
        'page_no'          => 'integer|gt:0',
        'page_size'        => 'integer|gt:0',
        'order_type'       => 'in:asc,desc',
        'order_field'      => 'in:delivery_item_id,name,phonetic,code,type',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'delivery_item_id' => '快递公司编号',
        'name'             => '快递公司名称',
        'phonetic'         => '快递公司首拼',
        'code'             => '快递公司编码',
        'type'             => '快递公司类型',
        'exclude_id'       => '快递公司排除Id',
        'company_all'      => '所有公司列表(包括已删除)',
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
        'set'       => [
            'delivery_item_id' => 'require|integer|gt:0',
            'name',
            'phonetic',
            'code',
            'type',
        ],
        'del'       => [
            'delivery_item_id' => 'require|arrayHasOnlyInts',
        ],
        'item'      => [
            'delivery_item_id' => 'require|integer|gt:0',
        ],
        'unique'    => [
            'code',
            'type',
            'exclude_id',
        ],
        'list'      => [
            'name' => 'max:50',
            'code' => 'max:30',
            'type' => 'integer|between:0,3',
            'company_all',
            'page_no',
            'page_size',
            'order_type',
            'order_field',
        ],
        'select'    => [
            'type' => 'integer|between:0,3',
            'order_type',
            'order_field',
        ],
        'hot'       => [
            'delivery_item_id' => 'require|integer|gt:0',
        ],
        'recognise' => [
            'code',
        ],
    ];
}
