<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    通知系统模板控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/7/18
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class NoticeTpl extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 获取一个通知系统模板
            'get.notice.tpl.item'   => ['getNoticeTplItem'],
            // 获取通知系统模板列表
            'get.notice.tpl.list'   => ['getNoticeTplList'],
            // 编辑一个通知系统模板
            'set.notice.tpl.item'   => ['setNoticeTplItem'],
            // 批量设置通知系统模板是否启用
            'set.notice.tpl.status' => ['setNoticeTplStatus'],
        ];
    }
}
