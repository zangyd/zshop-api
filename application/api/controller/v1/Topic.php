<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    专题控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/3/28
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Topic extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 添加一个专题
            'add.topic.item'   => ['addTopicItem'],
            // 编辑一个专题
            'set.topic.item'   => ['setTopicItem'],
            // 批量删除专题
            'del.topic.list'   => ['delTopicList'],
            // 获取一个专题
            'get.topic.item'   => ['getTopicItem'],
            // 获取专题列表
            'get.topic.list'   => ['getTopicList'],
            // 批量设置专题是否显示
            'set.topic.status' => ['setTopicStatus'],
        ];
    }
}
