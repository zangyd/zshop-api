<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    账号管理控制
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/3/31
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class User extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 验证账号是否合法
            'check.user.username' => ['checkUserName', 'app\common\service\User'],
            // 验证账号手机是否合法
            'check.user.mobile'   => ['checkUserMobile', 'app\common\service\User'],
            // 验证账号昵称是否合法
            'check.user.nickname' => ['checkUserNick', 'app\common\service\User'],
            // 注册一个新账号
            'add.user.item'       => ['addUserItem'],
            // 编辑一个账号
            'set.user.item'       => ['setUserItem'],
            // 批量设置账号状态
            'set.user.status'     => ['setUserStatus'],
            // 修改一个账号密码
            'set.user.password'   => ['setUserPassword'],
            // 批量删除账号
            'del.user.list'       => ['delUserList'],
            // 获取一个账号
            'get.user.item'       => ['getUserItem'],
            // 获取一个账号的简易信息
            'get.user.info'       => ['getUserInfo'],
            // 获取账号列表
            'get.user.list'       => ['getUserList'],
            // 获取指定账号的基础数据
            'get.user.select'     => ['getUserSelect'],
            // 注销账号
            'logout.user.user'    => ['logoutUser'],
            // 登录账号
            'login.user.user'     => ['loginUser'],
            // 刷新Token
            'refresh.user.token'  => ['refreshToken'],
            // 忘记密码
            'find.user.password'  => ['findUserPassword'],
        ];
    }
}
