<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品规格配置验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2019/11/28
 */

namespace app\common\validate;

class SpecConfig extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'spec_config_id' => 'integer|gt:0',
        'goods_id'       => 'require|integer|gt:0',
        'key_to_array'   => 'in:0,1',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'spec_config_id' => '商品规格配置编号',
        'goods_id'       => '商品编号',
        'key_to_array'   => '是否将规格键名转为数组',
    ];
}
