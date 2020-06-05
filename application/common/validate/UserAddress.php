<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    收货地址管理验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/3/30
 */

namespace app\common\validate;

class UserAddress extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'client_id'       => 'require|integer|gt:0',
        'user_address_id' => 'integer|gt:0',
        'consignee'       => 'require|length:1,30',
        'country'         => 'integer|egt:0',
        'region_list'     => 'require|arrayHasOnlyInts',
        'address'         => 'require|max:255',
        'zipcode'         => 'integer|max:20',
        'tel'             => 'max:20',
        'mobile'          => 'require|number|length:7,15',
        'is_default'      => 'in:0,1',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'client_id'       => '账号编号',
        'user_address_id' => '收货地址编号',
        'consignee'       => '姓名',
        'country'         => '国家',
        'region_list'     => '所在地区',
        'address'         => '详细地址',
        'zipcode'         => '邮编',
        'tel'             => '电话',
        'mobile'          => '手机号码',
        'is_default'      => '是否设为默认',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'set'         => [
            'client_id',
            'user_address_id' => 'require|integer|gt:0',
            'consignee',
            'country',
            'region_list',
            'address',
            'zipcode',
            'tel',
            'mobile',
            'is_default',
        ],
        'list'        => [
            'client_id',
        ],
        'item'        => [
            'client_id',
            'user_address_id' => 'require|integer|gt:0',
        ],
        'del'         => [
            'client_id',
            'user_address_id' => 'require|arrayHasOnlyInts',
        ],
        'default'     => [
            'user_address_id' => 'require|integer|gt:0',
        ],
        'maximum'     => [
            'client_id',
        ],
        'get_default' => [
            'client_id',
        ],
    ];
}
