<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    订单促销方式验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/5/31
 */

namespace app\common\validate;

class PromotionItem extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'promotion_id' => 'integer|gt:0',
        'quota'        => 'require|float|gt:0|regex:^\d+(\.\d{1,2})?$',
        'settings'     => 'require|array',
        'type'         => 'in:0,1,2,3,4',
        'value'        => 'float|egt:0|regex:^\d+(\.\d{1,2})?$',
        'description'  => 'max:255',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'promotion_id' => '促销编号',
        'quota'        => '促销限额',
        'settings'     => '促销方案配置',
        'type'         => '促销方案类型',
        'value'        => '促销方案数值',
        'description'  => '促销描述',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'add'      => [
            'promotion_id',
            'quota',
            'settings',
        ],
        'settings' => [
            'type'  => 'require|in:0,1,2,3,4',
            'value' => 'require|float|egt:0|regex:^\d+(\.\d{1,2})?$',
            'description',
        ],
    ];
}
