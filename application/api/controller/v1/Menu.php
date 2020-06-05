<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    菜单管理控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/3/9
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Menu extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个菜单
            'add.menu.item'      => ['addMenuItem'],
            // 获取一个菜单
            'get.menu.item'      => ['getMenuItem'],
            // 编辑一个菜单
            'set.menu.item'      => ['setMenuItem'],
            // 删除一个菜单
            'del.menu.item'      => ['delMenuItem'],
            // 获取菜单列表
            'get.menu.list'      => ['getMenuList'],
            // 根据Id获取导航数据
            'get.menu.id.navi'   => ['getMenuIdNavi'],
            // 根据Url获取导航数据
            'get.menu.url.navi'  => ['getMenuUrlNavi'],
            // 批量设置是否导航
            'set.menu.navi'      => ['setMenuNavi'],
            // 设置菜单排序
            'set.menu.sort'      => ['setMenuSort'],
            // 根据编号自动排序
            'set.menu.index'     => ['setMenuIndex'],
            // 设置菜单状态
            'set.menu.status'    => ['setMenuStatus'],
            // 根据权限获取菜单列表
            'get.menu.auth.list' => ['getMenuAuthList'],
        ];
    }
}
