<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    条形码验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2020/3/31
 */

namespace app\common\validate;

class Barcode extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'text'      => 'max:255',
        'type'      => 'in:code128,codabar,code11,code39,code39_extended,ean128,gs1128,i25,isbn,msi,postnet,s25,upca',
        'scale'     => 'integer',
        'thickness' => 'integer',
        'font_size' => 'integer',
        'generate'  => 'in:image,base64',
        'suffix'    => 'in:png,jpg,gif',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'text'      => '条形码文本',
        'type'      => '条形码类型',
        'scale'     => '条形码规格',
        'thickness' => '条形码厚度',
        'font_size' => '条形码字体大小',
        'generate'  => '条形码生成方式',
        'suffix'    => '条形码生成格式',
    ];
}
