<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    账号等级模型
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/3/30
 */

namespace app\common\model;

class UserLevel extends Zshop
{
    /**
     * 只读属性
     * @var array
     */
    protected $readonly = [
        'user_level_id',
    ];

    /**
     * 字段类型或者格式转换
     * @var array
     */
    protected $type = [
        'user_level_id' => 'integer',
        'amount'        => 'float',
        'discount'      => 'integer',
    ];

    /**
     * 获取一个账号等级
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function getLevelItem($data)
    {
        if (!$this->validateData($data, 'UserLevel.item')) {
            return false;
        }

        $result = self::get($data['user_level_id']);
        if (false !== $result) {
            return is_null($result) ? null : $result->toArray();
        }

        return false;
    }

    /**
     * 获取账号等级列表
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function getLevelList($data)
    {
        if (!$this->validateData($data, 'User.list')) {
            return false;
        }

        $result = self::all(function ($query) use ($data) {
            // 排序方式
            $orderType = !empty($data['order_type']) ? $data['order_type'] : 'asc';

            // 排序的字段
            $orderField = !empty($data['order_field']) ? $data['order_field'] : 'amount';

            $query->order([$orderField => $orderType]);
        });

        if (false !== $result) {
            return $result->toArray();
        }

        return false;
    }

    /**
     * 添加一个账号等级
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function addLevelItem($data)
    {
        if (!$this->validateData($data, 'UserLevel')) {
            return false;
        }

        // 避免无关字段
        unset($data['user_level_id']);

        if (false !== $this->allowField(true)->save($data)) {
            return $this->toArray();
        }

        return false;
    }

    /**
     * 编辑一个账号等级
     * @access public
     * @param  array $data 外部数据
     * @return array|false
     * @throws
     */
    public function setLevelItem($data)
    {
        if (!$this->validateSetData($data, 'UserLevel.set')) {
            return false;
        }

        $map['user_level_id'] = ['eq', $data['user_level_id']];
        $result = $this->where($map)->find();

        if (!$result) {
            return is_null($result) ? $this->setError('数据不存在') : false;
        }

        // 开启事务
        self::startTrans();

        try {
            if (false === $result->allowField(true)->save($data)) {
                throw new \Exception($result->getError());
            }

            $userDb = new User();
            if (false === $userDb->save(['level_icon' => $result->getAttr('icon')], $map)) {
                throw new \Exception($userDb->getError());
            }

            self::commit();
            return $result->toArray();
        } catch (\Exception $e) {
            self::rollback();
            return $this->setError($e->getMessage());
        }
    }

    /**
     * 批量删除账号等级
     * @access public
     * @param  array $data 外部数据
     * @return bool
     */
    public function delLevelList($data)
    {
        if (!$this->validateData($data, 'UserLevel.del')) {
            return false;
        }

        if (self::checkUnique(['user_level_id' => ['in', $data['user_level_id']]])) {
            return $this->setError('等级已在使用中,建议进行编辑修改');
        }

        self::destroy(function ($query) use ($data) {
            $query->where('user_level_id', 'in', $data['user_level_id']);
        });

        return true;
    }
}
