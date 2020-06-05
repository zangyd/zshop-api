<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/13
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Goods extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 检测商品货号是否唯一
            'unique.goods.code'          => ['uniqueGoodsCode'],
            // 添加一个商品
            'add.goods.item'             => ['addGoodsItem'],
            // 编辑一个商品
            'set.goods.item'             => ['setGoodsItem'],
            // 获取一个商品
            'get.goods.item'             => ['getGoodsItem'],
            // 批量删除或恢复商品(回收站)
            'del.goods.list'             => ['delGoodsList'],
            // 获取指定编号商品的基础数据
            'get.goods.select'           => ['getGoodsSelect'],
            // 批量设置或关闭商品可积分抵扣
            'set.integral.goods.list'    => ['setIntegralGoodsList'],
            // 批量设置商品是否推荐
            'set.recommend.goods.list'   => ['setRecommendGoodsList'],
            // 批量设置商品是否为新品
            'set.new.goods.list'         => ['setNewGoodsList'],
            // 批量设置商品是否为热卖
            'set.hot.goods.list'         => ['setHotGoodsList'],
            // 批量设置商品是否上下架
            'set.shelves.goods.list'     => ['setShelvesGoodsList'],
            // 设置商品排序
            'set.goods.sort'             => ['setGoodsSort'],
            // 获取商品关键词联想词
            'get.goods.keywords.suggest' => ['getGoodsKeywordsSuggest'],
            // 复制一个商品
            'copy.goods.item'            => ['copyGoodsItem'],
            // 获取管理后台商品列表
            'get.goods.admin.list'       => ['getGoodsAdminList'],
            // 根据商品分类获取指定类型的商品
            'get.goods.index.type'       => ['getGoodsIndexType'],
            // 根据商品分类获取前台商品列表页
            'get.goods.index.list'       => ['getGoodsIndexList'],
            // 获取指定商品的属性列表
            'get.goods.attr.list'        => ['getGoodsAttrList'],
            // 获取指定商品的规格组合列表
            'get.goods.spec.list'        => ['getGoodsSpecList'],
            // 获取指定商品的规格图
            'get.goods.spec.image'       => ['getGoodsSpecImage'],
            // 获取指定商品的属性配置数据
            'get.goods.attr.config'      => ['getAttrConfigItem', 'app\common\model\GoodsAttrConfig'],
            // 获取指定商品的规格配置数据
            'get.goods.spec.config'      => ['getSpecConfigItem', 'app\common\model\SpecConfig'],
            // 获取指定商品的规格菜单数据
            'get.goods.spec.menu'        => ['getGoodsSpecMenu'],
        ];
    }
}
