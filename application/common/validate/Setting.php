<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    系统配置验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/2/23
 */

namespace app\common\validate;

class Setting extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'data'   => 'require|array',
        'code'   => 'require',
        'value'  => 'max:65535',
        'name'   => 'max:255',
        'model'  => 'max:255',
        'module' => 'max:255',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'code'   => '键名',
        'value'  => '键值',
        'module' => '模块',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'get'         => [
            'code'   => 'arrayHasOnlyStrings',
            'module' => 'require|in:delivery_dist,payment,delivery,system_shopping,service,system_info,upload',
        ],
        'rule'        => [
            'data',
        ],
        'float'       => [
            'value' => 'require|float|regex:-?\d+(\.\d{1,2})?$',
        ],
        'integer'     => [
            'value' => 'require|integer|egt:0',
        ],
        'array'       => [
            'value' => 'array',
        ],
        'int_array'   => [
            'value' => 'arrayHasOnlyInts:zero',
        ],
        'between'     => [
            'value' => 'require|between:0,100',
        ],
        'status'      => [
            'value' => 'require|in:0,1',
        ],
        'string'      => [
            'value',
        ],
        'default_oss' => [
            'value' => 'require|in:Zshop,aliyun,qiniu',
        ],
    ];
}
