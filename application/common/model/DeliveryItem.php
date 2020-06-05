<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    快递公司模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/25
 */

namespace app\common\model;

use util\Phonetic;
use think\helper\Str;
use think\Config;

class DeliveryItem extends Zshop
{
    /**
     * 快递鸟查询URL
     * @var string
     */
    const KDNIAO_URL = 'http://api.kdniao.com/Ebusiness/EbusinessOrderHandle.aspx';

    /**
     * 隐藏属性
     * @var array
     */
    protected $hidden = [
        'is_delete',
    ];

    /**
     * 只读属性
     * @var array
     */
    protected $readonly = [
        'delivery_item_id',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'delivery_item_id' => 'integer',
        'type'             => 'integer',
        'is_delete'        => 'integer',
    ];

    /**
     * 添加一个快递公司
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function addCompanyItem($data)
    {
        if (!$this->validateData($data, 'DeliveryItem')) {
            return false;
        }

        // 避免无关字段
        unset($data['delivery_item_id'], $data['is_delete']);

        // 检测编码是否重复
        $map['code'] = ['eq', $data['code']];
        $map['type'] = ['eq', $data['type']];
        $map['is_delete'] = ['eq', 0];

        if (self::checkUnique($map)) {
            return $this->setError('快递公司编码已存在');
        }

        // 获取快递公司首拼
        if (!isset($data['phonetic'])) {
            $data['phonetic'] = Phonetic::encode(Str::substr($data['name'], 0, 1));
            $data['phonetic'] = Str::lower($data['phonetic']);
        }

        if (false !== $this->allowField(true)->save($data)) {
            return $this->toArray();
        }

        return false;
    }

    /**
     * 编辑一个快递公司
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function setCompanyItem($data)
    {
        if (!$this->validateSetData($data, 'DeliveryItem.set')) {
            return false;
        }

        $result = self::get(function ($query) use ($data) {
            $map['delivery_item_id'] = ['eq', $data['delivery_item_id']];
            $map['is_delete'] = ['eq', 0];

            $query->where($map);
        });

        if (!$result) {
            return is_null($result) ? $this->setError('数据不存在') : false;
        }

        // 编码是否重复检测
        if (!empty($data['code']) || isset($data['type'])) {
            $map['delivery_item_id'] = ['neq', $data['delivery_item_id']];
            $map['code'] = !empty($data['code']) ? $data['code'] : $result->getAttr('code');
            $map['type'] = isset($data['type']) ? $data['type'] : $result->getAttr('type');
            $map['is_delete'] = ['eq', 0];

            if (self::checkUnique($map)) {
                return $this->setError('快递公司编码已存在');
            }
        }

        // 获取快递公司首拼
        if (isset($data['name']) && !isset($data['phonetic'])) {
            $data['phonetic'] = Phonetic::encode(Str::substr($data['name'], 0, 1));
            $data['phonetic'] = Str::lower($data['phonetic']);
        }

        if (false !== $result->allowField(true)->isUpdate(true)->save($data)) {
            return $result->toArray();
        }

        return false;
    }

    /**
     * 批量删除快递公司
     * @access public
     * @param  array $data 外部数据
     * @return bool
     * @throws
     */
    public function delCompanyList($data)
    {
        if (!$this->validateData($data, 'DeliveryItem.del')) {
            return false;
        }

        $result = self::get(function ($query) use ($data) {
            $query
                ->alias('i')
                ->field('i.delivery_item_id,i.name')
                ->join('delivery d', 'd.delivery_item_id = i.delivery_item_id')
                ->where(['i.delivery_item_id' => ['in', $data['delivery_item_id']]]);
        });

        if ($result) {
            $error = 'Id:' . $result->getAttr('delivery_item_id') . ' "';
            $error .= $result->getAttr('name') . '"正在被配送方式使用';
            return $this->setError($error);
        }

        $map['delivery_item_id'] = ['in', $data['delivery_item_id']];
        if (false !== $this->save(['is_delete' => 1], $map)) {
            return true;
        }

        return false;
    }

    /**
     * 获取一个快递公司
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function getCompanyItem($data)
    {
        if (!$this->validateData($data, 'DeliveryItem.item')) {
            return false;
        }

        $result = self::get(function ($query) use ($data) {
            $map['delivery_item_id'] = ['eq', $data['delivery_item_id']];
            $map['is_delete'] = ['eq', 0];

            $query->where($map);
        });

        if (false !== $result) {
            return is_null($result) ? null : $result->toArray();
        }

        return false;
    }

    /**
     * 查询快递公司编码是否已存在
     * @access public
     * @param  array $data 外部数据
     * @return bool
     */
    public function uniqueCompanyCode($data)
    {
        if (!$this->validateData($data, 'DeliveryItem.unique')) {
            return false;
        }

        $map['code'] = ['eq', $data['code']];
        $map['type'] = ['eq', $data['type']];
        $map['is_delete'] = ['eq', 0];
        !isset($data['exclude_id']) ?: $map['delivery_item_id'] = ['neq', $data['exclude_id']];

        if (self::checkUnique($map)) {
            return $this->setError('快递公司编码已存在');
        }

        return true;
    }

    /**
     * 获取快递公司列表
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function getCompanyList($data)
    {
        if (!$this->validateData($data, 'DeliveryItem.list')) {
            return false;
        }

        // 搜索条件
        $map = [];
        empty($data['name']) ?: $map['name'] = ['like', '%' . $data['name'] . '%'];
        empty($data['code']) ?: $map['code'] = ['eq', $data['code']];
        is_empty_parm($data['type']) ?: $map['type'] = ['eq', $data['type']];
        isset($data['company_all']) && $data['company_all'] == 1 ?: $map['is_delete'] = ['eq', 0];

        $totalResult = $this->where($map)->count();
        if ($totalResult <= 0) {
            return ['total_result' => 0];
        }

        $result = self::all(function ($query) use ($data, $map) {
            // 翻页页数
            $pageNo = isset($data['page_no']) ? $data['page_no'] : 1;

            // 每页条数
            $pageSize = isset($data['page_size']) ? $data['page_size'] : config('paginate.list_rows');

            // 排序方式
            $orderType = !empty($data['order_type']) ? $data['order_type'] : 'asc';

            // 排序的字段
            $orderField = !empty($data['order_field']) ? $data['order_field'] : 'type';

            $query
                ->where($map)
                ->order([$orderField => $orderType])
                ->page($pageNo, $pageSize);
        });

        if (false !== $result) {
            return ['items' => $result->toArray(), 'total_result' => $totalResult];
        }

        return false;
    }

    /**
     * 获取快递公司选择列表
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function getCompanySelect($data)
    {
        if (!$this->validateData($data, 'DeliveryItem.select')) {
            return false;
        }

        $result = self::all(function ($query) use ($data) {
            $map['is_delete'] = ['eq', 0];
            is_empty_parm($data['type']) ?: $map['type'] = ['eq', $data['type']];

            // 排序方式
            $orderType = !empty($data['order_type']) ? $data['order_type'] : 'asc';

            // 排序的字段
            $orderField = !empty($data['order_field']) ? $data['order_field'] : 'delivery_item_id';

            $query
                ->where($map)
                ->order([$orderField => $orderType]);
        });

        if (false !== $result) {
            return $result->toArray();
        }

        return false;
    }

    /**
     * 根据快递单号识别快递公司
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     */
    public function getCompanyRecognise($data)
    {
        if (!$this->validateData($data, 'DeliveryItem.recognise')) {
            return false;
        }

        // 请求正文内容
        $requestData = ['LogisticCode' => $data['code']];
        $requestData = json_encode($requestData, JSON_UNESCAPED_UNICODE);

        // 请求系统参数
        $postData = [
            'RequestData' => urlencode($requestData),
            'EBusinessID' => Config::get('api_id.value', 'delivery_dist'),
            'RequestType' => '2002',
            'DataSign'    => \app\common\service\DeliveryDist::getCallbackSign($requestData),
            'DataType'    => '2',
        ];

        $result = \util\Http::httpPost(self::KDNIAO_URL, $postData);
        $result = json_decode($result, true);

        if (!isset($result['Success']) || true != $result['Success']) {
            return $this->setError($result['Code']);
        }

        return [
            'logistic_code' => $result['LogisticCode'],
            'shippers'      => \app\common\service\DeliveryDist::snake($result['Shippers']),
        ];
    }

    /**
     * 复制一个快递公司为"热门类型"
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function copyCompanyHot($data)
    {
        if (!$this->validateData($data, 'DeliveryItem.hot')) {
            return false;
        }

        $result = self::get(function ($query) use ($data) {
            $map['delivery_item_id'] = ['eq', $data['delivery_item_id']];
            $map['is_delete'] = ['eq', 0];

            $query->where($map);
        });

        if (!$result) {
            return is_null($result) ?$this->setError('数据不存在') : false;
        }

        $map['code'] = ['eq', $result->getAttr('code')];
        $map['type'] = ['eq', 0];
        $map['is_delete'] = ['eq', 0];

        if (self::checkUnique($map)) {
            return $this->setError('该快递公司已在热门列表中');
        }

        $result->setAttr('type', 0);
        $result->setAttr('delivery_item_id', null);

        if (false !== $result->isUpdate(false)->save()) {
            return $result->toArray();
        }

        return false;
    }
}
