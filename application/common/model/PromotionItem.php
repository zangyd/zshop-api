<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    订单促销方案模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/5/31
 */

namespace app\common\model;

class PromotionItem extends Zshop
{
    /**
     * 隐藏属性
     * @var array
     */
    protected $hidden = [
        'promotion_id',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'promotion_id' => 'integer',
        'quota'        => 'float',
        'settings'     => 'array',
    ];

    /**
     * 添加促销方案
     * @access public
     * @param  array $settings    促销方案配置
     * @param  int   $promotionId 促销编号
     * @return array|false
     * @throws
     */
    public function addPromotionItem($settings, $promotionId)
    {
        // 处理外部填入数据并进行验证
        foreach ($settings as $key => $item) {
            if (!$this->validateData($settings[$key], 'PromotionItem.add')) {
                return false;
            }

            foreach ($item['settings'] as $value) {
                if (!$this->validateData($value, 'PromotionItem.settings')) {
                    return false;
                }
            }

            $settings[$key]['promotion_id'] = $promotionId;
        }

        $result = $this->allowField(true)->isUpdate(false)->saveAll($settings);
        if (false !== $result) {
            return $result->toArray();
        }

        return false;
    }
}
