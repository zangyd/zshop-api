<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    客服控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/3/28
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Support extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一名客服
            'add.support.item'   => ['addSupportItem'],
            // 编辑一名客服
            'set.support.item'   => ['setSupportItem'],
            // 批量删除客服
            'del.support.list'   => ['delSupportList'],
            // 获取一名客服
            'get.support.item'   => ['getSupportItem'],
            // 获取客服列表
            'get.support.list'   => ['getSupportList'],
            // 批量设置客服状态
            'set.support.status' => ['setSupportStatus'],
            // 设置客服排序
            'set.support.sort'   => ['setSupportSort'],
            // 根据编号自动排序
            'set.support.index'  => ['setSupportIndex'],
        ];
    }
}
