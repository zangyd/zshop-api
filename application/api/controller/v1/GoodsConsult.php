<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品咨询控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/10
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class GoodsConsult extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个新的商品咨询
            'add.goods.consult.item'   => ['addConsultItem'],
            // 批量删除商品咨询
            'del.goods.consult.list'   => ['delConsultList'],
            // 批量设置是否前台显示
            'set.goods.consult.show'   => ['setConsultShow'],
            // 回复一个商品咨询
            'reply.goods.consult.item' => ['replyConsultItem'],
            // 获取一个商品咨询问答明细
            'get.goods.consult.item'   => ['getConsultItem'],
            // 获取商品咨询列表
            'get.goods.consult.list'   => ['getConsultList'],
        ];
    }
}
