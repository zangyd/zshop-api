<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    IP地址查询验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2019/11/21
 */

namespace app\common\validate;

class IpLocation extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'ip' => 'require|arrayHasOnlyStrings',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'ip' => 'IP',
    ];
}
