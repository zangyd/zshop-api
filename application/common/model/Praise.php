<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    点赞记录模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/6/22
 */

namespace app\common\model;

class Praise extends Zshop
{
    /**
     * 只读属性
     * @var array
     */
    protected $readonly = [
        'praise_id',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'praise_id'        => 'integer',
        'user_id'          => 'integer',
        'goods_comment_id' => 'integer',
    ];
}
