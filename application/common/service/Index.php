<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    API协助接口服务层
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/1/26
 */

namespace app\common\service;

class Index extends Zshop
{
    /**
     * 调整最优状态(正式环境有效)
     * @access public
     * @return array|false
     */
    public function setSystemOptimize()
    {
        if (ini_get('safe_mode')) {
            return $this->setError('PHP安全模式下无法运行');
        }

        if (config('app_debug') === true) {
            return $this->setError('调试模式下不需要执行');
        }

        if (!function_exists('shell_exec')) {
            return $this->setError('shell_exec 函数未启用');
        }

        $shell = [
            'autoload'   => 'optimize:autoload',    // 生成类库映射文件
            'route'      => 'optimize:route',       // 生成路由缓存
            'config'     => 'optimize:config',      // 生成配置缓存
            'config_api' => 'optimize:config api',  // 生成配置缓存(api模块)
            'schema'     => 'optimize:schema',      // 生成数据表字段缓存
        ];

        $result = [];
        $rootPath = ROOT_PATH . 'Zshop';

        foreach ($shell as $key => $value) {
            $output = shell_exec(sprintf('php "%s" %s', $rootPath, $value));
            $result[$key] = chop($output);
        }

        sleep(2);
        return !empty($result) ? $result : false;
    }

    /**
     * 清空所有缓存
     * @access public
     * @return bool
     */
    public function clearCacheAll()
    {
        \think\Cache::clear();
        sleep(3);

        return true;
    }

    /**
     * 获取系统版本号
     * @access public
     * @return array
     */
    public function getVersion()
    {
        return ['version' => get_version()];
    }
}
