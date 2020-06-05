<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    导航控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/5/7
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Navigation extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个导航
            'add.navigation.item'   => ['addNavigationItem'],
            // 编辑一个导航
            'set.navigation.item'   => ['setNavigationItem'],
            // 批量删除导航
            'del.navigation.list'   => ['delNavigationList'],
            // 获取一个导航
            'get.navigation.item'   => ['getNavigationItem'],
            // 获取导航列表
            'get.navigation.list'   => ['getNavigationList'],
            // 批量设置是否新开窗口
            'set.navigation.target' => ['setNavigationTarget'],
            // 批量设置是否启用
            'set.navigation.status' => ['setNavigationStatus'],
            // 设置导航排序
            'set.navigation.sort'   => ['setNavigationSort'],
            // 根据编号自动排序
            'set.navigation.index'  => ['setNavigationIndex'],
        ];
    }
}
