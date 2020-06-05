<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品规格列表验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/21
 */

namespace app\common\validate;

class SpecGoods extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'goods_id'  => 'require|integer|gt:0',
        'key_name'  => 'require',
        'key_value' => 'require|max:100',
        'price'     => 'require|float|gt:0|regex:^\d+(\.\d{1,2})?$',
        'store_qty' => 'require|integer|egt:0',
        'bar_code'  => 'max:60',
        'goods_sku' => 'max:50',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'goods_id'  => '规格列表中的商品编码',
        'key_name'  => '规格列表中的商品规格键名',
        'key_value' => '规格列表中的商品规格值',
        'price'     => '规格列表中的商品价格',
        'store_qty' => '规格列表中的商品库存',
        'bar_code'  => '规格列表中的商品条码',
        'goods_sku' => '规格列表中的商品SKU',
    ];
}
