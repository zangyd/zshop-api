<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    通知系统可用变量模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/7/18
 */

namespace app\common\model;

class NoticeItem extends Zshop
{
    /**
     * 隐藏属性
     * @var array
     */
    protected $hidden = [
        'notice_item_id',
        'type',
    ];

    /**
     * 只读属性
     * @var array
     */
    protected $readonly = [
        'notice_item_id',
        'item_name',
        'replace_name',
        'type',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'notice_item_id' => 'integer',
        'type'           => 'integer',
    ];
}
