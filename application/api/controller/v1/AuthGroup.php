<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    用户组控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/3/29
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class AuthGroup extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个用户组
            'add.auth.group.item'   => ['addAuthGroupItem'],
            // 编辑一个用户组
            'set.auth.group.item'   => ['setAuthGroupItem'],
            // 获取一个用户组
            'get.auth.group.item'   => ['getAuthGroupItem'],
            // 删除一个用户组
            'del.auth.group.item'   => ['delAuthGroupItem'],
            // 获取用户组列表
            'get.auth.group.list'   => ['getAuthGroupList'],
            // 批量设置用户组状态
            'set.auth.group.status' => ['setAuthGroupStatus'],
            // 设置用户组排序
            'set.auth.group.sort'   => ['setAuthGroupSort'],
            // 根据编号自动排序
            'set.auth.group.index'  => ['setAuthGroupIndex'],
        ];
    }
}
