<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    帮助文档控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2019/3/19
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Help extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一条帮助文档
            'add.help.item'    => ['addHelpItem'],
            // 编辑一条帮助文档
            'set.help.item'    => ['setHelpItem'],
            // 获取一条帮助文档
            'get.help.item'    => ['getHelpItem'],
            // 验证帮助文档是否唯一
            'unique.help.item' => ['uniqueHelpItem'],
            // 获取帮助文档列表
            'get.help.list'    => ['getHelpList'],
            // 根据路由获取帮助文档
            'get.help.router'  => ['getHelpRouter'],
        ];
    }
}
