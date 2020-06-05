<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    二维码生成验证器
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/7/27
 */

namespace app\common\validate;

class Qrcode extends Zshop
{
    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'qrcode_id'   => 'integer|gt:0',
        'name'        => 'max:64',
        'text'        => 'max:255',
        'size'        => 'integer|gt:0',
        'logo'        => 'max:512',
        'suffix'      => 'in:png,jpg,gif',
        'generate'    => 'in:image,base64',
        'page_no'     => 'integer|gt:0',
        'page_size'   => 'integer|gt:0',
        'order_type'  => 'in:asc,desc',
        'order_field' => 'in:qrcode_id',
    ];

    /**
     * 字段描述
     * @var array
     */
    protected $field = [
        'qrcode_id'   => '二维码编号',
        'name'        => '二维码名称',
        'text'        => '二维码内容',
        'size'        => '二维码图片大小',
        'logo'        => '二维码LOGO',
        'suffix'      => '二维码后缀',
        'generate'    => '二维码生成方式',
        'page_no'     => '页码',
        'page_size'   => '每页数量',
        'order_type'  => '排序方式',
        'order_field' => '排序字段',
    ];

    /**
     * 场景规则
     * @var array
     */
    protected $scene = [
        'add'    => [
            'name' => 'require|max:64',
            'text',
            'size',
            'logo',
            'suffix',
        ],
        'set'    => [
            'qrcode_id' => 'require|integer|gt:0',
            'name',
            'text',
            'size',
            'logo',
            'suffix',
        ],
        'config' => [
            'qrcode_id' => 'require|integer|gt:0',
        ],
        'list'   => [
            'name',
            'page_no',
            'page_size',
            'order_type',
            'order_field',
        ],
        'del'    => [
            'qrcode_id' => 'require|arrayHasOnlyInts',
        ],
    ];
}
