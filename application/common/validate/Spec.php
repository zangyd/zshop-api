<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品规格验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/10
 */

namespace app\common\validate;

class Spec extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'spec_id'       => 'integer|gt:0',
        'goods_type_id' => 'require|integer|gt:0',
        'name'          => 'require|max:60',
        'spec_item'     => 'require|arrayHasOnlyStrings',
        'spec_index'    => 'in:0,1',
        'spec_type'     => 'in:0,1,2',
        'sort'          => 'integer|between:0,255',
        'is_detail'     => 'in:0,1',
        'page_no'       => 'integer|gt:0',
        'page_size'     => 'integer|gt:0',
        'order_type'    => 'in:asc,desc',
        'order_field'   => 'in:spec_id,goods_type_id,name,spec_index,sort',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'spec_id'       => '商品规格编号',
        'goods_type_id' => '所属商品模型编号',
        'name'          => '商品规格名称',
        'spec_item'     => '商品规格项',
        'spec_index'    => '商品规格检索',
        'spec_type'     => '商品规格展现方式',
        'sort'          => '商品规格排序值',
        'is_detail'     => '是否完整数据',
        'page_no'       => '页码',
        'page_size'     => '每页数量',
        'order_type'    => '排序方式',
        'order_field'   => '排序字段',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'set'   => [
            'spec_id' => 'require|integer|gt:0',
            'goods_type_id',
            'name',
            'spec_item',
            'spec_index',
            'spec_type',
            'sort',
        ],
        'del'   => [
            'spec_id' => 'require|arrayHasOnlyInts',
        ],
        'item'  => [
            'spec_id' => 'require|integer|gt:0',
            'is_detail',
        ],
        'key'   => [
            'spec_id'    => 'require|arrayHasOnlyInts',
            'spec_index' => 'require|in:0,1',
        ],
        'page'  => [
            'goods_type_id' => 'integer|gt:0',
            'is_detail',
            'page_no',
            'page_size',
            'order_type',
            'order_field',
        ],
        'list'  => [
            'goods_type_id',
        ],
        'sort'  => [
            'spec_id' => 'require|integer|gt:0',
            'sort'    => 'require|integer|between:0,255',
        ],
        'index' => [
            'spec_id' => 'require|arrayHasOnlyInts',
        ],
    ];
}
