<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品规格列表模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/21
 */

namespace app\common\model;

class SpecGoods extends Zshop
{
    /**
     * 隐藏属性
     * @var array
     */
    protected $hidden = [
        'goods_id',
    ];

    /**
     * 只读属性
     * @var array
     */
    protected $readonly = [
        'goods_id',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'goods_id'  => 'integer',
        'price'     => 'float',
        'store_qty' => 'integer',
    ];

    /**
     * 添加商品规格列表
     * @access public
     * @param  int   $goodsId 商品编号
     * @param  array $data    外部数据
     * @return bool
     * @throws
     */
    public function addGoodsSpec($goodsId, $data)
    {
        // 处理部分数据,并进行验证
        foreach ($data as $key => $value) {
            $data[$key]['goods_id'] = $goodsId;

            if (!$this->validateData($data[$key], 'SpecGoods')) {
                return false;
            }

            // 将规格项编号转为"_"链接的字符串
            if (is_array($data[$key]['key_name'])) {
                $data[$key]['key_name'] = implode('_', $value['key_name']);
            }
        }

        $result = $this->allowField(true)->saveAll($data);
        return false !== $result;
    }
}
