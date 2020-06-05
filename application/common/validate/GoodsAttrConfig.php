<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品属性配置验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2019/11/28
 */

namespace app\common\validate;

class GoodsAttrConfig extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'goods_attr_config_id' => 'integer|gt:0',
        'goods_id'             => 'require|integer|gt:0',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'goods_attr_config_id' => '商品属性配置编号',
        'goods_id'             => '商品编号',
    ];
}
