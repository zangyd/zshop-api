<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品评价回复控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/11
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class GoodsReply extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 对商品评价添加一个回复(管理组不参与评价回复)
            'add.goods.reply.item' => ['addReplyItem'],
            // 批量删除商品评价的回复
            'del.goods.reply.list' => ['delReplyList'],
            // 获取商品评价回复列表
            'get.goods.reply.list' => ['getReplyList'],
        ];
    }
}
