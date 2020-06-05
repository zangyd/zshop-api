<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    商品规格配置模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2019/11/28
 */

namespace app\common\model;

class SpecConfig extends Zshop
{
    /**
     * 只读属性
     * @var array
     */
    protected $readonly = [
        'spec_config_id',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'spec_config_id' => 'integer',
        'goods_id'       => 'integer',
        'config_data'    => 'array',
    ];

    /**
     * hasMany cs_spec_goods
     * @access public
     * @return mixed
     */
    public function specCombo()
    {
        return $this->hasMany('SpecGoods', 'goods_id', 'goods_id');
    }

    /**
     * 新增或编辑指定的商品规格配置
     * @access public
     * @param  number $goodsId    商品编号
     * @param  array  $configData 属性配置数据
     * @throws
     */
    public static function updateSpecConfig($goodsId, $configData)
    {
        $result = self::where(['goods_id' => ['eq', $goodsId]])->find();
        if (is_null($result)) {
            self::create(['goods_id' => $goodsId, 'config_data' => $configData]);
        } else {
            $result->setAttr('config_data', $configData)->save();
        }
    }

    /**
     * 获取指定商品的规格配置数据
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function getSpecConfigItem($data)
    {
        if (!$this->validateData($data, 'SpecConfig')) {
            return false;
        }

        $result = self::get(function ($query) use ($data) {
            $query->with('specCombo')->where(['goods_id' => ['eq', $data['goods_id']]]);
        });

        if (false !== $result) {
            $resultData = ['spec_config' => [], 'spec_combo' => [], 'spec_key' => []];
            if (is_null($result)) {
                return $resultData;
            }

            $resultData['spec_config'] = $result->getAttr('config_data');
            $resultData['spec_combo'] = $result->getAttr('spec_combo');
            $resultData['spec_key'] = array_column($resultData['spec_config'], 'spec_id');

            if (!empty($data['key_to_array'])) {
                foreach ($resultData['spec_combo'] as &$value) {
                    $value['key_name'] = explode('_', $value['key_name']);
                }

                unset($value);
            }

            return $resultData;
        }

        return false;
    }
}
