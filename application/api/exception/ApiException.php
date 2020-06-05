<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    Api异常类接管
 *
 * @author      zachary <zangyd@163.com>
 * @date        2017/03/22
 */

namespace app\api\exception;

use think\exception\Handle;
use think\exception\HttpException;

class ApiException extends Handle
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Exception $e
     * @return mixed
     */
    public function render(\Exception $e)
    {
        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
        }

        if (!isset($statusCode)) {
            $statusCode = 500;
        }

        return ApiOutput::outPut([], $statusCode, true, $e->getMessage());
    }
}
