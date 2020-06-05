<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    提现账号验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/6/20
 */

namespace app\common\validate;

class WithdrawUser extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'withdraw_user_id' => 'integer|gt:0',
        'client_id'        => 'require|integer|gt:0',
        'name'             => 'require|max:32',
        'mobile'           => 'require|number|length:7,15',
        'bank_name'        => 'require|max:50',
        'account'          => 'require|max:100',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'withdraw_user_id' => '提现账号编号',
        'client_id'        => '账号编号',
        'name'             => '收款人姓名',
        'mobile'           => '收款人手机号',
        'bank_name'        => '收款账户',
        'account'          => '收款账号',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'set'     => [
            'withdraw_user_id' => 'require|integer|gt:0',
            'client_id',
            'name',
            'mobile',
            'bank_name',
            'account',
        ],
        'del'     => [
            'withdraw_user_id' => 'require|arrayHasOnlyInts',
            'client_id',
        ],
        'item'    => [
            'withdraw_user_id' => 'require|integer|gt:0',
            'client_id',
        ],
        'list'    => [
            'client_id',
        ],
        'maximum' => [
            'client_id',
        ],
    ];
}
