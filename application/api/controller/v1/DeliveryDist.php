<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    配送轨迹控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/27
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class DeliveryDist extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一条配送轨迹
            'add.delivery.dist.item'     => ['addDeliveryDistItem'],
            // 接收推送过来的配送轨迹
            'put.delivery.dist.data'     => ['putDeliveryDistData'],
            // 根据流水号获取配送轨迹
            'get.delivery.dist.code'     => ['getDeliveryDistCode'],
            // 获取配送轨迹列表
            'get.delivery.dist.list'     => ['getDeliveryDistList'],
            // 根据快递单号即时查询配送轨迹
            'get.delivery.dist.trace'    => ['getDeliveryDistTrace'],
            // 获取配送回调URL接口
            'get.delivery.dist.callback' => ['getDistCallback', 'app\common\service\DeliveryDist'],
        ];
    }
}
