<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    通知系统服务层
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/1/26
 */

namespace app\common\service;

use think\Config;

class Notice extends Zshop
{
    /**
     * 获取通知系统列表
     * @access public
     * @return array|false
     */
    public static function getNoticeList()
    {
        $result = Config::get(null, 'notice');
        foreach ($result as $key => $value) {
            if (!empty($value['value'])) {
                $result[$key]['value'] = json_decode($value['value'], true);
            }
        }

        return $result;
    }
}
