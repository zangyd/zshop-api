<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    系统配置模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/2/12
 */

namespace app\common\model;

use think\Config;
use think\Cache;

class Setting extends Zshop
{
    /**
     * 只读属性
     * @var array
     */
    protected $readonly = [
        'setting_id',
        'code',
        'module',
        'description',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'setting_id' => 'integer',
    ];

    /**
     * 获取某个模块的设置
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     */
    public function getSettingList($data)
    {
        if (!$this->validateData($data, 'Setting.get')) {
            return false;
        }

        $result = Config::get(null, $data['module']);
        foreach ($result as &$value) {
            $temp = json_decode($value['value'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $value['value'] = $temp;
            }
        }

        unset($value);

        if (!empty($data['code'])) {
            foreach ($result as $key => $value) {
                if (!in_array($key, $data['code'])) {
                    unset($result[$key]);
                }
            }

            unset($key, $value);
        }

        return $result;
    }

    /**
     * 设置某个模块下的配置参数
     * @access private
     * @param  string $key    键名
     * @param  mixed  $value  值
     * @param  string $module 模块
     * @param  string $rule   规则
     * @param  bool   $toJson 是否转为json
     * @throws \Exception
     */
    private function setSettingItem($key, $value, $module, $rule, $toJson = false)
    {
        if (!$this->validateData(['value' => $value], $rule)) {
            throw new \Exception($key . $this->getError());
        }

        $map['code'] = ['eq', $key];
        $map['module'] = ['eq', $module];

        !$toJson ?: $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        if (false === $this->where($map)->update(['value' => $value])) {
            throw new \Exception($this->getError());
        }

        Config::set($key . '.value', $value, $module);
    }

    /**
     * 设置配送轨迹
     * @access public
     * @param  array $data 外部数据
     * @return bool
     * @throws
     */
    public function setDeliveryDistList($data)
    {
        if (!$this->validateData($data, 'Setting.rule')) {
            return false;
        }

        // 开启事务
        self::startTrans();

        try {
            foreach ($data['data'] as $key => $value) {
                switch ($key) {
                    case 'api_id':
                    case 'api_key':
                        $this->setSettingItem($key, $value, 'delivery_dist', 'Setting.string');
                        break;

                    case 'is_sub':
                        $this->setSettingItem($key, $value, 'delivery_dist', 'Setting.status');
                        break;

                    default:
                        throw new \Exception('键名' . $key . '不在允许范围内');
                }
            }

            self::commit();
            Cache::rm('setting');
            return true;
        } catch (\Exception $e) {
            self::rollback();
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 设置支付完成提示页
     * @access public
     * @param  array $data 外部数据
     * @return bool
     * @throws
     */
    public function setPaymentList($data)
    {
        if (!$this->validateData($data, 'Setting.rule')) {
            return false;
        }

        // 开启事务
        self::startTrans();

        try {
            foreach ($data['data'] as $key => $value) {
                switch ($key) {
                    case 'success':
                    case 'error':
                        $this->setSettingItem($key, $value, 'payment', 'Setting.string');
                        break;

                    default:
                        throw new \Exception('键名' . $key . '不在允许范围内');
                }
            }

            self::commit();
            Cache::rm('setting');
            return true;
        } catch (\Exception $e) {
            self::rollback();
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 设置配送优惠
     * @access public
     * @param  array $data 外部数据
     * @return bool
     * @throws
     */
    public function setDeliveryList($data)
    {
        if (!$this->validateData($data, 'Setting.rule')) {
            return false;
        }

        // 开启事务
        self::startTrans();

        try {
            foreach ($data['data'] as $key => $value) {
                // 未填写则默认为0
                !empty($value) ?: $value = 0;
                switch ($key) {
                    case 'money':
                    case 'quota':
                    case 'dec_money':
                        $this->setSettingItem($key, $value, 'delivery', 'Setting.float');
                        break;

                    case 'number':
                        $this->setSettingItem($key, $value, 'delivery', 'Setting.integer');
                        break;

                    case 'money_status':
                    case 'number_status':
                    case 'dec_status':
                        $this->setSettingItem($key, $value, 'delivery', 'Setting.status');
                        break;

                    case 'money_exclude':
                    case 'number_exclude':
                    case 'dec_exclude':
                        !empty($value) ?: $value = [];
                        $this->setSettingItem($key, $value, 'delivery', 'Setting.int_array', true);
                        break;

                    default:
                        throw new \Exception('键名' . $key . '不在允许范围内');
                }
            }

            self::commit();
            Cache::rm('setting');
            return true;
        } catch (\Exception $e) {
            self::rollback();
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 设置购物系统
     * @access public
     * @param  array $data 外部数据
     * @return bool
     * @throws
     */
    public function setShoppingList($data)
    {
        if (!$this->validateData($data, 'Setting.rule')) {
            return false;
        }

        // 开启事务
        self::startTrans();

        try {
            foreach ($data['data'] as $key => $value) {
                !empty($value) ?: $value = 0;
                switch ($key) {
                    case 'integral':
                    case 'timeout':
                    case 'complete':
                        $this->setSettingItem($key, $value, 'system_shopping', 'Setting.integer');
                        break;

                    case 'is_country':
                        $this->setSettingItem($key, $value, 'system_shopping', 'Setting.status');
                        break;

                    case 'spacer':
                    case 'source':
                        empty($value) && $value = '';
                        $this->setSettingItem($key, $value, 'system_shopping', 'Setting.string');
                        break;

                    case 'invoice':
                    case 'withdraw_fee':
                        $this->setSettingItem($key, $value, 'system_shopping', 'Setting.between');
                        break;

                    default:
                        throw new \Exception('键名' . $key . '不在允许范围内');
                }
            }

            self::commit();
            Cache::rm('setting');
            return true;
        } catch (\Exception $e) {
            self::rollback();
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 设置售后服务
     * @access public
     * @param  array $data 外部数据
     * @return bool
     * @throws
     */
    public function setServiceList($data)
    {
        if (!$this->validateData($data, 'Setting.rule')) {
            return false;
        }

        // 开启事务
        self::startTrans();

        try {
            foreach ($data['data'] as $key => $value) {
                switch ($key) {
                    case 'days':
                        !empty($value) ?: $value = 0;
                        $this->setSettingItem($key, $value, 'service', 'Setting.integer');
                        break;

                    case 'address':
                    case 'consignee':
                    case 'zipcode':
                    case 'mobile':
                        $this->setSettingItem($key, $value, 'service', 'Setting.string');
                        break;

                    default:
                        throw new \Exception('键名' . $key . '不在允许范围内');
                }
            }

            self::commit();
            Cache::rm('setting');
            return true;
        } catch (\Exception $e) {
            self::rollback();
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 设置系统配置
     * @access public
     * @param  array $data 外部数据
     * @return bool
     * @throws
     */
    public function setSystemList($data)
    {
        if (!$this->validateData($data, 'Setting.rule')) {
            return false;
        }

        // 开启事务
        self::startTrans();

        try {
            foreach ($data['data'] as $key => $value) {
                switch ($key) {
                    case 'open_index':
                    case 'open_api':
                    case 'open_mobile':
                    case 'home_captcha':
                    case 'admin_captcha':
                        !empty($value) ?: $value = 0;
                        $this->setSettingItem($key, $value, 'system_info', 'Setting.status');
                        break;

                    case 'close_reason':
                    case 'name':
                    case 'title':
                    case 'keywords':
                    case 'description':
                    case 'logo':
                    case 'square_logo':
                    case 'information':
                    case 'miitbeian':
                    case 'miitbeian_url':
                    case 'miitbeian_ico':
                    case 'beian':
                    case 'beian_url':
                    case 'beian_ico':
                    case 'weixin_url':
                    case 'third_count':
                    case 'qrcode_logo':
                    case 'platform':
                        $this->setSettingItem($key, $value, 'system_info', 'Setting.string');
                        break;

                    case 'allow_origin':
                    case 'card_auth':
                        !empty($value) ?: $value = [];
                        $this->setSettingItem($key, $value, 'system_info', 'Setting.array', true);
                        break;

                    default:
                        throw new \Exception('键名' . $key . '不在允许范围内');
                }
            }

            self::commit();
            Cache::rm('setting');
            return true;
        } catch (\Exception $e) {
            self::rollback();
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 检测上传大小是否符合服务器限制
     * @access private
     * @param  array $data 外部数据
     * @return bool
     */
    private function checkPostMaxSize($data)
    {
        if (!array_key_exists('default', $data) && !array_key_exists('file_size', $data)) {
            return true;
        }

        $module = array_key_exists('default', $data)
            ? $data['default']
            : Config::get('default.value', 'upload');

        if (\oss\Zshop\Upload::MODULE !== $module) {
            return true;
        }

        $fileSize = array_key_exists('file_size', $data)
            ? $data['file_size']
            : Config::get('file_size.value', 'upload');

        $serverSize = ini_get('upload_max_filesize');
        if (string_to_byte($fileSize) > string_to_byte($serverSize)) {
            return $this->setError(\oss\Zshop\Upload::NAME . ' 上传大小最大仅支持 ' . $serverSize);
        }

        return true;
    }

    /**
     * 检测地址是否不包含前缀(http、https)
     * @access private
     * @param string $key   键名
     * @param string $value 键值
     * @return bool
     * @throws \Exception
     */
    private function checkUrl($key, $value)
    {
        $url = [
            'oss'           => '资源获取短地址',
            'Zshop_url' => '资源绑定域名别名',
            'qiniu_url'     => '外链域名',
            'aliyun_url'    => 'Bucket 域名',
        ];

        if (!array_key_exists($key, $url)) {
            return true;
        }

        if (preg_match('/^((https|http)?:\/\/)[^\s]+/', $value)) {
            throw new \Exception($url[$key] . '不需要添加地址前缀');
        }

        return true;
    }

    /**
     * 设置上传配置
     * @access public
     * @param  array $data 外部数据
     * @return bool
     * @throws
     */
    public function setUploadList($data)
    {
        if (!$this->validateData($data, 'Setting.rule')) {
            return false;
        }

        if (!$this->checkPostMaxSize($data['data'])) {
            return false;
        }

        // 开启事务
        self::startTrans();

        try {
            foreach ($data['data'] as $key => $value) {
                switch ($key) {
                    case 'default':
                        $this->setSettingItem($key, $value, 'upload', 'Setting.default_oss');
                        break;

                    case 'file_size':
                        !empty($value) ?: $value = '0M';
                        $this->setSettingItem($key, $value, 'upload', 'Setting.string');
                        break;

                    case 'oss':
                    case 'Zshop_url':
                    case 'qiniu_url':
                    case 'aliyun_url':
                        $this->checkUrl($key, $value);
                        $this->setSettingItem($key, $value, 'upload', 'Setting.string');
                        break;

                    case 'image_ext':
                    case 'file_ext':
                    case 'qiniu_access_key':
                    case 'qiniu_secret_key':
                    case 'qiniu_bucket':
                    case 'aliyun_access_key':
                    case 'aliyun_secret_key':
                    case 'aliyun_bucket':
                    case 'aliyun_endpoint':
                    case 'aliyun_rolearn':
                        $this->setSettingItem($key, $value, 'upload', 'Setting.string');
                        break;

                    case 'token_expires':
                        empty($value) && $value = 0;
                        $this->setSettingItem($key, $value, 'upload', 'Setting.integer');
                        break;

                    default:
                        throw new \Exception('键名' . $key . '不在允许范围内');
                }
            }

            self::commit();
            Cache::rm('setting');
            return true;
        } catch (\Exception $e) {
            self::rollback();
            return $this->setError($e->getMessage());
        }
    }
}
