<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    广告位置控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/3/29
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class AdsPosition extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个广告位置
            'add.ads.position.item'    => ['addPositionItem'],
            // 编辑一个广告位置
            'set.ads.position.item'    => ['setPositionItem'],
            // 批量删除广告位置
            'del.ads.position.list'    => ['delPositionList'],
            // 验证广告位置编号是否唯一
            'unique.ads.position.code' => ['uniquePositionCode'],
            // 批量设置广告位置状态
            'set.ads.position.status'  => ['setPositionStatus'],
            // 获取一个广告位置
            'get.ads.position.item'    => ['getPositionItem'],
            // 获取广告位置列表
            'get.ads.position.list'    => ['getPositionList'],
            // 获取广告位置选择列表
            'get.ads.position.select'  => ['getPositionSelect'],
            // 根据广告位置编码获取广告列表
            'get.ads.position.code'    => ['getPositionCode'],
        ];
    }
}
