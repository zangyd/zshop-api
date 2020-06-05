<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    二维码控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/7/27
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;

class Qrcode extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 动态生成一个二维码
            'get.qrcode.item'    => ['getQrcodeItem'],
            // 获取二维码调用地址
            'get.qrcode.callurl' => ['getQrcodeCallurl', 'app\common\service\Qrcode'],
            // 添加一个二维码
            'add.qrcode.item'    => ['addQrcodeItem'],
            // 编辑一个二维码
            'set.qrcode.item'    => ['setQrcodeItem'],
            // 获取一个二维码
            'get.qrcode.config'  => ['getQrcodeConfig'],
            // 获取二维码列表
            'get.qrcode.list'    => ['getQrcodeList'],
            // 批量删除二维码
            'del.qrcode.list'    => ['delQrcodeList'],
        ];
    }
}
