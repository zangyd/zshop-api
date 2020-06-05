<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    用户组验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/3/29
 */

namespace app\common\validate;

class AuthGroup extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'group_id'    => 'integer|gt:0',
        'name'        => 'require|max:32',
        'description' => 'max:255',
        'module'      => 'require|checkModule',
        'sort'        => 'integer|between:0,255',
        'status'      => 'in:0,1',
        'exclude_id'  => 'arrayHasOnlyInts',
        'order_type'  => 'in:asc,desc',
        'order_field' => 'in:group_id,name,sort,status',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'group_id'    => '用户组编号',
        'name'        => '用户组名称',
        'description' => '用户组描述',
        'module'      => '所属模块',
        'sort'        => '用户组排序值',
        'status'      => '用户组状态',
        'exclude_id'  => '用户组排除Id',
        'order_type'  => '排序方式',
        'order_field' => '排序字段',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'set'    => [
            'group_id' => 'require|integer|gt:0',
            'name',
            'description',
            'module',
            'sort',
            'status',
        ],
        'item'   => [
            'group_id' => 'require|integer|gt:0',
        ],
        'del'    => [
            'group_id' => 'require|integer|gt:0',
        ],
        'list'   => [
            'module' => 'checkModule',
            'status',
            'exclude_id',
            'order_type',
            'order_field',
        ],
        'status' => [
            'group_id' => 'require|arrayHasOnlyInts',
            'status'   => 'require|in:0,1',
        ],
        'sort'   => [
            'group_id' => 'require|integer|gt:0',
            'sort'     => 'require|integer|between:0,255',
        ],
        'index'  => [
            'group_id' => 'require|arrayHasOnlyInts',
        ],
    ];
}
