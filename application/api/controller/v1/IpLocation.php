<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    IP地址查询控制器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2019/11/20
 */

namespace app\api\controller\v1;

use app\api\controller\Zshop;
use util\Ip2Region;

class IpLocation extends Zshop
{
    /**
     * 方法路由器
     * @access protected
     * @return array
     */
    protected static function initMethod()
    {
        return [
            // 查询一条IPv4信息
            'get.ip.location' => ['getIpLocation', false],
        ];
    }

    /**
     * 查询一条IPv4信息
     * @access protected
     * @return array|bool
     */
    protected function getIpLocation()
    {
        $data = $this->getParams();
        $validate = $this->validate($data, 'IpLocation');

        if (true !== $validate) {
            return $this->setError($validate);
        }

        $result = [];
        $ip2region = new Ip2Region();

        foreach ($data['ip'] as $key => $value) {
            try {
                $result[$key] = $ip2region->btreeSearch($value);
                $result[$key]['status'] = 200;
            } catch (\exception $e) {
                $result[$key]['error'] = $e->getMessage();
                $result[$key]['status'] = 500;
            }
        }

        return $result;
    }
}
