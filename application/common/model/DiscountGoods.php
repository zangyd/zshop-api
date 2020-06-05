<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    折扣商品模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/5/31
 */

namespace app\common\model;

class DiscountGoods extends Zshop
{
    /**
     * 隐藏属性
     * @var array
     */
    protected $hidden = [
        'discount_id',
    ];

    /**
     * 只读属性
     * @var array
     */
    protected $readonly = [
        'discount_id',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'discount_id'       => 'integer',
        'goods_id'          => 'integer',
        'discount'          => 'float',
    ];

    /**
     * hasMany cs_goods
     * @access public
     * @return mixed
     */
    public function getGoods()
    {
        return $this
            ->hasOne('Goods', 'goods_id', 'goods_id')
            ->field('goods_id,name,store_qty,sales_sum,status,is_delete');
    }

    /**
     * 添加折扣商品
     * @access public
     * @param  array $discountGoods 商品数据
     * @param  int   $discountId    折扣编号
     * @return array|false
     * @throws
     */
    public function addDiscountGoods($discountGoods, $discountId)
    {
        // 处理外部填入数据并进行验证
        foreach ($discountGoods as $key => $value) {
            if (!$this->validateData($discountGoods[$key], 'DiscountGoods')) {
                return false;
            }

            $discountGoods[$key]['discount_id'] = $discountId;
        }

        $result = $this->allowField(true)->isUpdate(false)->saveAll($discountGoods);
        if (false !== $result) {
            return $result->toArray();
        }

        return false;
    }

    /**
     * 根据商品编号获取折扣信息
     * @access public
     * @param  array $data 外部数据
     * @return false|array
     * @throws
     */
    public function getDiscountGoodsInfo($data)
    {
        if (!$this->validateData($data, 'DiscountGoods.info')) {
            return false;
        }

        // 搜索条件
        $map['g.goods_id'] = ['in', $data['goods_id']];
        $map['d.begin_time'] = ['elt', time()];
        $map['d.end_time'] = ['egt', time()];
        $map['d.status'] = ['eq', 1];

        $result = self::all(function ($query) use ($map) {
            $field = 'd.name,d.type,g.goods_id,g.discount,';
            $field .= 'from_unixtime(d.begin_time) as begin_time,';
            $field .= 'from_unixtime(d.end_time) as end_time';

            $query
                ->alias('g')
                ->field($field)
                ->join('discount d', 'd.discount_id = g.discount_id')
                ->where($map);
        });

        if (false !== $result) {
            return $result->toArray();
        }

        return [];
    }

    /**
     * 根据编号获取折扣商品明细
     * @access public
     * @param  array $data 外部数据
     * @return false|array
     * @throws
     */
    public function getDiscountGoodsList($data)
    {
        if (!$this->validateData($data, 'DiscountGoods.list')) {
            return false;
        }

        $result = self::all(function ($query) use ($data) {
            $query
                ->with('getGoods')
                ->where(['discount_id' => ['eq', $data['discount_id']]]);
        });

        if (false !== $result) {
            return $result->toArray();
        }

        return false;
    }
}
