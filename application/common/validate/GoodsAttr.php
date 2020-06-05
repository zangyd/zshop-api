<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品属性列表验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/20
 */

namespace app\common\validate;

class GoodsAttr extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'goods_id'           => 'require|integer|gt:0',
        'goods_attribute_id' => 'require|integer|gt:0',
        'parent_id'          => 'require|integer|egt:0',
        'is_important'       => 'require|in:0,1',
        'attr_value'         => 'max:512',
        'sort'               => 'integer|between:0,255',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'goods_id'           => '商品属性中的商品编号',
        'goods_attribute_id' => '商品属性中的商品属性编号',
        'parent_id'          => '商品属性中的商品属性主体',
        'is_important'       => '商品属性中的是否核心属性',
        'attr_value'         => '商品属性中的属性值',
        'sort'               => '商品属性中的排序值',
    ];
}
