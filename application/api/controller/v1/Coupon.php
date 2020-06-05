<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    优惠劵控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/5/18
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Coupon extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一张优惠劵
            'add.coupon.item'    => ['addCouponItem'],
            // 编辑一张优惠劵
            'set.coupon.item'    => ['setCouponItem'],
            // 获取一张优惠劵
            'get.coupon.item'    => ['getCouponItem'],
            // 获取优惠劵列表
            'get.coupon.list'    => ['getCouponList'],
            // 获取优惠劵选择列表
            'get.coupon.select'  => ['getCouponSelect'],
            // 批量删除优惠劵
            'del.coupon.list'    => ['delCouponList'],
            // 批量设置优惠劵状态
            'set.coupon.status'  => ['setCouponStatus'],
            // 批量设置优惠劵是否失效
            'set.coupon.invalid' => ['setCouponInvalid'],
            // 获取当前可领取的优惠劵列表
            'get.coupon.active'  => ['getCouponActive'],
        ];
    }
}
