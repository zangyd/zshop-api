<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    帮助文档验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2019/3/19
 */

namespace app\common\validate;

class Help extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'help_id'    => 'integer|gt:0',
        'router'     => 'require|max:100',
        'ver'        => 'require|max:16|regex:^\d+(\.\d+){0,3}$',
        'module'     => 'require|checkModule',
        'content'    => 'require',
        'url'        => 'max:255|url',
        'exclude_id' => 'integer|gt:0',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'help_id'    => '帮助文档编号',
        'router'     => '帮助文档路由',
        'ver'        => '帮助文档版本号',
        'module'     => '所属模块',
        'content'    => '文档内容',
        'url'        => '链接地址',
        'exclude_id' => '帮助文档排除Id',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'set'    => [
            'help_id' => 'require|integer|gt:0',
            'router',
            'ver',
            'module',
            'content',
            'url',
        ],
        'item'   => [
            'help_id' => 'require|integer|gt:0',
        ],
        'unique' => [
            'router',
            'ver',
            'module',
            'exclude_id',
        ],
        'list'   => [
            'router'  => 'max:100',
            'ver'     => 'max:16|regex:^\d+(\.\d+){0,3}$',
            'module'  => 'checkModule',
            'content' => 'max:100',
            'url',
        ],
        'router' => [
            'router',
            'ver',
            'module',
        ],
    ];
}
