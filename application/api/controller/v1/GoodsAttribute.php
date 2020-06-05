<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品属性控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/7
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class GoodsAttribute extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个商品属性主体
            'add.goods.attribute.body.item' => ['addAttributeBodyItem'],
            // 编辑一个商品属性主体
            'set.goods.attribute.body.item' => ['setAttributeBodyItem'],
            // 获取一个商品属性主体
            'get.goods.attribute.body.item' => ['getAttributeBodyItem'],
            // 获取商品属性主体列表
            'get.goods.attribute.body.list' => ['getAttributeBodyList'],
            // 添加一个商品属性
            'add.goods.attribute.item'      => ['addAttributeItem'],
            // 编辑一个商品属性
            'set.goods.attribute.item'      => ['setAttributeItem'],
            // 获取一个商品属性
            'get.goods.attribute.item'      => ['getAttributeItem'],
            // 获取商品属性列表(可翻页)
            'get.goods.attribute.page'      => ['getAttributePage'],
            // 获取商品属性列表
            'get.goods.attribute.list'      => ['getAttributeList'],
            // 批量设置商品属性检索
            'set.goods.attribute.key'       => ['setAttributeKey'],
            // 批量设置商品属性是否核心
            'set.goods.attribute.important' => ['setAttributeImportant'],
            // 设置主体或属性的排序值
            'set.goods.attribute.sort'      => ['setAttributeSort'],
            // 根据编号自动排序
            'set.goods.attribute.index'     => ['setAttributeIndex'],
            // 批量删除商品主体或属性
            'del.goods.attribute.list'      => ['delAttributeList'],
            // 获取基础数据索引列表
            'get.goods.attribute.data'      => ['getAttributeData'],
        ];
    }
}
