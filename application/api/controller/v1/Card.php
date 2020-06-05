<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    购物卡控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/11/20
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Card extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一条购物卡
            'add.card.item'   => ['addCardItem'],
            // 编辑一条购物卡
            'set.card.item'   => ['setCardItem'],
            // 获取一条购物卡
            'get.card.item'   => ['getCardItem'],
            // 批量设置购物卡状态
            'set.card.status' => ['setCardStatus'],
            // 批量删除购物卡
            'del.card.list'   => ['delCardList'],
            // 获取购物卡列表
            'get.card.list'   => ['getCardList'],
        ];
    }
}
