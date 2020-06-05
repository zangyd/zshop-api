<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品评价回复验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/11
 */

namespace app\common\validate;

class GoodsReply extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'goods_reply_id'   => 'integer|gt:0',
        'goods_comment_id' => 'require|integer|gt:0',
        'to_name'          => 'max:50',
        'content'          => 'require|max:200',
        'is_anon'          => 'in:0,1',
        'page_no'          => 'integer|gt:0',
        'page_size'        => 'integer|gt:0',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'goods_reply_id'   => '商品评价回复编号',
        'goods_comment_id' => '商品评价编号',
        'to_name'          => '被回复者昵称',
        'content'          => '回复内容',
        'is_anon'          => '是否匿名',
        'page_no'          => '页码',
        'page_size'        => '每页数量',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'del'  => [
            'goods_reply_id' => 'require|arrayHasOnlyInts',
        ],
        'list' => [
            'goods_comment_id',
            'page_no',
            'page_size',
        ],
    ];
}
