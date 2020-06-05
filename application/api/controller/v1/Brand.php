<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    品牌控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/1
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Brand extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个品牌
            'add.brand.item'    => ['addBrandItem'],
            // 编辑一个品牌
            'set.brand.item'    => ['setBrandItem'],
            // 批量删除品牌
            'del.brand.list'    => ['delBrandList'],
            // 批量设置品牌是否显示
            'set.brand.status'  => ['setBrandStatus'],
            // 验证品牌名称是否唯一
            'unique.brand.name' => ['uniqueBrandName'],
            // 获取一个品牌
            'get.brand.item'    => ['getBrandItem'],
            // 获取品牌列表
            'get.brand.list'    => ['getBrandList'],
            // 获取品牌选择列表
            'get.brand.select'  => ['getBrandSelect'],
            // 设置品牌排序
            'set.brand.sort'    => ['setBrandSort'],
            // 根据编号自动排序
            'set.brand.index'   => ['setBrandIndex'],
        ];
    }
}
