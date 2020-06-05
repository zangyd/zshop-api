<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    应用管理验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/3/24
 */

namespace app\common\validate;

class App extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'app_id'     => 'integer|gt:0',
        'app_name'   => 'require|max:30|unique:app,app_name,0,app_id',
        'captcha'    => 'require|in:0,1',
        'status'     => 'in:0,1',
        'exclude_id' => 'integer|gt:0',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'app_id'     => '应用编号',
        'app_name'   => '应用名称',
        'captcha'    => '应用验证码',
        'status'     => '应用状态',
        'exclude_id' => '应用排除Id',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'set'     => [
            'app_id'   => 'require|integer|gt:0',
            'app_name' => 'require|max:30',
            'captcha',
            'status',
        ],
        'item'    => [
            'app_id' => 'require|integer|gt:0',
        ],
        'del'     => [
            'app_id' => 'require|arrayHasOnlyInts',
        ],
        'unique'  => [
            'app_name' => 'require|max:30',
            'exclude_id',
        ],
        'replace' => [
            'app_id' => 'require|integer|gt:0',
        ],
        'captcha' => [
            'app_id'  => 'require|arrayHasOnlyInts',
            'captcha' => 'require|in:0,1',
        ],
        'status'  => [
            'app_id' => 'require|arrayHasOnlyInts',
            'status' => 'require|in:0,1',
        ],
        'list'    => [
            'app_name' => 'max:30',
            'status'   => 'in:0,1',
        ],
    ];
}
