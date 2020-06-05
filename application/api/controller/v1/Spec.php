<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品规格控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/10
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Spec extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个商品规格
            'add.goods.spec.item'  => ['addSpecItem'],
            // 编辑一个商品规格
            'set.goods.spec.item'  => ['setSpecItem'],
            // 获取一条商品规格
            'get.goods.spec.item'  => ['getSpecItem'],
            // 获取商品规格列表(可翻页)
            'get.goods.spec.page'  => ['getSpecPage'],
            // 获取商品规格列表
            'get.goods.spec.list'  => ['getSpecList'],
            // 获取所有商品规格及规格项
            'get.goods.spec.all'   => ['getSpecAll'],
            // 批量删除商品规格
            'del.goods.spec.list'  => ['delSpecList'],
            // 批量设置商品规格检索
            'set.goods.spec.key'   => ['setSpecKey'],
            // 设置商品规格排序
            'set.goods.spec.sort'  => ['setSpecSort'],
            // 根据编号自动排序
            'set.goods.spec.index' => ['setSpecIndex'],
        ];
    }
}
