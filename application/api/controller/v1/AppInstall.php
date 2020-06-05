<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    应用安装包控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/3/9
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class AppInstall extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个应用安装包
            'add.app.install.item'      => ['addAppInstallItem'],
            // 编辑一个应用安装包
            'set.app.install.item'      => ['setAppInstallItem'],
            // 获取一个应用安装包
            'get.app.install.item'      => ['getAppInstallItem'],
            // 批量删除应用安装包
            'del.app.install.list'      => ['delAppInstallList'],
            // 获取应用安装包列表
            'get.app.install.list'      => ['getAppInstallList'],
            // 根据条件查询是否有更新
            'query.app.install.updated' => ['queryAppInstallUpdated'],
            // 根据请求获取一个应用安装包
            'request.app.install.item'  => ['requestAppInstallItem'],
        ];
    }
}
