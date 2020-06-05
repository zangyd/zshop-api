<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    账号资金验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/6/22
 */

namespace app\common\validate;

class UserMoney extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'client_id' => 'require|integer|gt:0',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'client_id' => '账号编号',
    ];
}
