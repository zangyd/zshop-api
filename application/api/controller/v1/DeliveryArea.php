<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    配送区域控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/3/28
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class DeliveryArea extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个配送区域
            'add.delivery.area.item' => ['addAreaItem'],
            // 编辑一个配送区域
            'set.delivery.area.item' => ['setAreaItem'],
            // 批量删除配送区域
            'del.delivery.area.list' => ['delAreaList'],
            // 获取一个配送区域
            'get.delivery.area.item' => ['getAreaItem'],
            // 获取配送区域列表
            'get.delivery.area.list' => ['getAreaList'],
        ];
    }
}
