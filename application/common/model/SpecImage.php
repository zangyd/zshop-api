<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品规格图片模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/4/21
 */

namespace app\common\model;

class SpecImage extends Zshop
{
    /**
     * 隐藏属性
     * @var array
     */
    protected $hidden = [
        'goods_id',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'goods_id'     => 'integer',
        'spec_item_id' => 'integer',
        'spec_type'    => 'integer',
        'image'        => 'array',
    ];

    /**
     * 添加商品规格图片
     * @access public
     * @param  int   $goodsId 商品编号
     * @param  array $data    外部数据
     * @return bool
     * @throws
     */
    public function addSpecImage($goodsId, $data)
    {
        // 处理部分数据,并进行验证
        foreach ($data as $key => $value) {
            $data[$key]['goods_id'] = $goodsId;

            if (!$this->validateData($data[$key], 'SpecImage')) {
                return false;
            }
        }

        $result = $this->allowField(true)->saveAll($data);
        return false !== $result;
    }
}
