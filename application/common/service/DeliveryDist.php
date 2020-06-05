<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    配送轨迹服务层
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/1/26
 */

namespace app\common\service;

use think\Config;
use think\Url;
use think\helper\Str;

class DeliveryDist extends Zshop
{
    /**
     * 生成快递鸟签名
     * @access public
     * @param  string $data 请求内容
     * @return string
     */
    public static function getCallbackSign($data)
    {
        return urlencode(base64_encode(md5($data . Config::get('api_key.value', 'delivery_dist'))));
    }

    /**
     * 获取配送回调URL接口
     * @access public
     * @return array
     */
    public static function getDistCallback()
    {
        $vars = ['method' => 'put.delivery.dist.data'];
        $callbackUrl = Url::bUild('/api/v1/delivery_dist', $vars, true, true);

        return ['callback_url' => $callbackUrl];
    }

    /**
     * 将数组键名驼峰转下划线
     * @access public
     * @param  array $data 数据
     * @return array
     */
    public static function snake($data)
    {
        if (empty($data)) {
            return [];
        }

        foreach ($data as $itemKey => $item) {
            foreach ($item as $valueKey => $value) {
                $data[$itemKey][Str::snake($valueKey)] = $value;
                unset($data[$itemKey][$valueKey]);
            }
        }

        return $data;
    }
}
