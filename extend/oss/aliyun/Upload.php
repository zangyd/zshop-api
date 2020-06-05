<?php
/**
 * @copyright   Copyright (c) ZacharyAll rights reserved.
 *
 * Zshop    阿里云OSS
 *
 * @author      zachary <zangyd@163.com>
 * @date        2018/1/23
 */

namespace oss\aliyun;

use app\common\model\Storage;
use oss\Upload as UploadBase;
use OSS\OssClient;
use OSS\Core\OssException;
use think\Cache;
use think\Config;
use think\Url;
use aliyun\AssumeRoleRequest;
use aliyun\core\Config as AliyunConfig;
use aliyun\core\profile\DefaultProfile;
use aliyun\core\DefaultAcsClient;
use util\Http;

class Upload extends UploadBase
{
    /**
     * 模块名称
     * @var string
     */
    const NAME = '阿里云 OSS';

    /**
     * 模块
     * @var string
     */
    const MODULE = 'aliyun';

    /**
     * 主机区域后缀
     * @var string
     */
    const HOST = '.aliyuncs.com';

    /**
     * 获取回调推送地址
     * @access private
     * @return string
     */
    private function getCallbackUrl()
    {
        $vars = ['method' => 'put.upload.data', 'module' => self::MODULE];
        $callbackUrl = Url::bUild('/api/v1/upload', $vars, true, true);

        return $callbackUrl;
    }

    /**
     * 获取上传地址
     * @access public
     * @return array|false
     */
    public function getUploadUrl()
    {
        // 请求获取bucket所在数据中心位置信息
        $location = Cache::remember('aliyunLocation', function () {
            $accessKeyId = Config::get('aliyun_access_key.value', 'upload');
            $accessKeySecret = Config::get('aliyun_secret_key.value', 'upload');
            $endPoint = Config::get('aliyun_endpoint.value', 'upload');
            $bucket = Config::get('aliyun_bucket.value', 'upload');

            try {
                $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endPoint);
                $result = $ossClient->getBucketLocation($bucket);

                if (false === $result = xml_to_array($result)) {
                    throw new OssException('解析数据失败');
                }
            } catch (OssException $e) {
                return $this->setError($e->getMessage());
            }

            $random = array_rand($result, 1);
            return $bucket . '.' . $result[$random] . self::HOST;
        }, 7200);

        if (false === $location) {
            Cache::rm('aliyunLocation');
            return false;
        }

        $uploadUrl = Url::bUild('/', '', false, $location);
        $param = [
            ['name' => 'x:replace', 'type' => 'hidden', 'default' => $this->replace],
            ['name' => 'x:parent_id', 'type' => 'hidden', 'default' => 0],
            ['name' => 'x:filename', 'type' => 'hidden', 'default' => ''],
            ['name' => 'OSSAccessKeyId', 'type' => 'hidden', 'default' => ''],
            ['name' => 'policy', 'type' => 'hidden', 'default' => ''],
            ['name' => 'Signature', 'type' => 'hidden', 'default' => ''],
            ['name' => 'callback', 'type' => 'hidden', 'default' => ''],
            ['name' => 'key', 'type' => 'hidden', 'default' => $this->replace],
            ['name' => 'success_action_status', 'type' => 'hidden', 'default' => 200],
            ['name' => 'file', 'type' => 'file', 'default' => ''],
        ];

        return ['upload_url' => $uploadUrl, 'module' => self::MODULE, 'param' => $param];
    }

    /**
     * 获取上传Token
     * @access public
     * @param  string $replace 替换资源(path)
     * @return array
     */
    public function getToken($replace = '')
    {
        empty($replace) ?: $this->replace = $replace;
        $token = $this->request->param('type') === 'app' ? $this->getAppToken() : $this->getWebToken();

        return $token;
    }

    /**
     * 获取表单上传所需Token
     * @access private
     * @return array|false
     */
    private function getWebToken()
    {
        // 获取配置数据
        $accessKeyId = Config::get('aliyun_access_key.value', 'upload');
        $accessKeySecret = Config::get('aliyun_secret_key.value', 'upload');

        $timestamp = new \DateTime();
        $expires = time() + Config::get('token_expires.value', 'upload');
        $dir = 'uploads/files/' . date('Ymd/', time());

        if (!empty($this->replace)) {
            $pathInfo = pathinfo($this->replace);
            empty($pathInfo['dirname']) ?: $dir = $pathInfo['dirname'] . '/';
        }

        $policyArray = [
            'expiration' => $timestamp->setTimestamp($expires)->format('Y-m-d\TH:i:s\Z'),
            'conditions' => [
                ['content-length-range', 0, string_to_byte(Config::get('file_size.value', 'upload'))],
                ['starts-with', '$key', $dir],
            ],
        ];

        $policy = json_encode($policyArray, JSON_UNESCAPED_UNICODE);
        $policyBase64 = base64_encode($policy);
        $stringToSign = $policyBase64;
        $signature = base64_encode(hash_hmac('sha1', $stringToSign, $accessKeySecret, true));

        $uploadUrl = $this->getUploadUrl();
        if (false === $uploadUrl) {
            return false;
        }

        $response['upload_url'] = $uploadUrl;
        $response['OSSAccessKeyId'] = $accessKeyId;
        $response['policy'] = $policyBase64;
        $response['Signature'] = $signature;
        $response['callback'] = base64_encode($this->getCallbackData());
        $response['dir'] = $dir;

        return ['token' => $response, 'expires' => $expires];
    }

    /**
     * 获取回调参数
     * @access private
     * @return string
     */
    private function getCallbackData()
    {
        // 回调参数(别用JSON,阿里云传过来的JSON格式能坑死你)
        $callbackBody = 'replace=${x:replace}&parent_id=${x:parent_id}&filename=${x:filename}&mime=${mimeType}&';
        $callbackBody .= 'size=${size}&width=${imageInfo.width}&height=${imageInfo.height}&path=${object}&hash=${etag}';

        // 创建回调数据
        $callbackParam = [
            'callbackUrl'      => $this->getCallbackUrl(),
            'callbackBody'     => $callbackBody,
            'callbackBodyType' => 'application/x-www-form-urlencoded',
        ];

        return json_encode($callbackParam, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取STS临时授权Token(SDK或APP使用)
     * @access private
     * @return array|false
     */
    private function getAppToken()
    {
        // 获取配置数据
        $accessKeyId = Config::get('aliyun_access_key.value', 'upload');
        $accessKeySecret = Config::get('aliyun_secret_key.value', 'upload');
        $roleArn = Config::get('aliyun_rolearn.value', 'upload');
        $bucket = Config::get('aliyun_bucket.value', 'upload');
        $tokenExpires = Config::get('token_expires.value', 'upload');
        $tokenExpires < 900 && $tokenExpires = 900;

        // 加载区域结点配置
        AliyunConfig::load();

        // 创建STS请求配置
        $iClientProfile = DefaultProfile::getProfile('cn-hangzhou', $accessKeyId, $accessKeySecret);
        $client = new DefaultAcsClient($iClientProfile);

        // 创建授权策略 工具 http://gosspublic.alicdn.com/ram-policy-editor/index.html
        $policy = [
            'Version'   => '1',
            'Statement' => [
                [
                    'Effect'   => 'Allow',
                    'Action'   => [
                        'oss:PutObject',
                    ],
                    'Resource' => [
                        'acs:oss:*:*:*',
                    ],
                ],
            ],
        ];

        // 向阿里云请求获取Token
        try {
            $request = new AssumeRoleRequest();
            $request->setRoleSessionName('temp_user');
            $request->setRoleArn($roleArn);
            $request->setPolicy(json_encode($policy, JSON_UNESCAPED_UNICODE));
            $request->setDurationSeconds($tokenExpires);
            $response = $client->getAcsResponse($request);
        } catch (\exception $e) {
            return $this->setError($e->getMessage());
        }

        $result = [
            'assumed_role_user' => [
                'assumed_role_id' => $response['AssumedRoleUser']['AssumedRoleId'],
                'arn'             => $response['AssumedRoleUser']['Arn'],
            ],
            'credentials'       => [
                'access_key_id'     => $response['Credentials']['AccessKeyId'],
                'access_key_secret' => $response['Credentials']['AccessKeySecret'],
                'security_token'    => $response['Credentials']['SecurityToken'],
                'expiration'        => $response['Credentials']['Expiration'],
            ],
            'policy'            => json_encode($policy, JSON_UNESCAPED_UNICODE),
            'bucket'            => $bucket,
            'callback'          => $this->getCallbackData(),
            'callback_url'      => $this->getCallbackUrl(),
            'expires'           => time() + $tokenExpires,
        ];

        return $result;
    }

    /**
     * 接收第三方推送数据
     * @access public
     * @return array|false
     * @throws
     */
    public function putUploadData()
    {
        // 获取OSS的签名header和公钥url header
        $authorizationBase64 = $this->request->server('HTTP_AUTHORIZATION', '');
        $pubKeyUrlBase64 = $this->request->server('HTTP_X_OSS_PUB_KEY_URL', '');

        if ($authorizationBase64 == '' || $pubKeyUrlBase64 == '') {
            return $this->setError(self::NAME . '模块异常访问!');
        }

        // 获取签名和公钥
        $authorization = base64_decode($authorizationBase64);
        $pubKeyUrl = base64_decode($pubKeyUrlBase64);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $pubKeyUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $pubKey = curl_exec($ch);

        if ($pubKey == '') {
            return $this->setError(self::NAME . '模块获取失败!');
        }

        // 获取回调body
        $body = file_get_contents('php://input');

        // 拼接待签名字符串
        $path = $this->request->server('REQUEST_URI');
        $pos = mb_strpos($path, '?', null, 'utf-8');
        if ($pos === false) {
            $authStr = urldecode($path) . "\n" . $body;
        } else {
            $authStr = urldecode(mb_substr($path, 0, $pos, 'utf-8')) . mb_substr($path, $pos, mb_strlen($path, 'utf-8') - $pos, 'utf-8');
            $authStr .= ("\n" . $body);
        }

        // 验证签名
        $isVerify = openssl_verify($authStr, $authorization, $pubKey, OPENSSL_ALGO_MD5);
        if ($isVerify != 1) {
            return $this->setError(self::NAME . '模块非法访问!');
        }

        // 获取参数
        $params = $this->request->param();

        // 判断是否为图片
        $isImage = (int)$params['width'] > 0 && (int)$params['height'] > 0;

        // 准备写入数据库
        $data = [
            'parent_id' => (int)$params['parent_id'],
            'name'      => !empty($params['filename']) ? $params['filename'] : basename($params['path']),
            'mime'      => $params['mime'],
            'ext'       => mb_strtolower(pathinfo($params['path'], PATHINFO_EXTENSION), 'utf-8'),
            'size'      => $params['size'],
            'pixel'     => $isImage ? ['width' => (int)$params['width'], 'height' => (int)$params['height']] : [],
            'hash'      => $params['hash'],
            'path'      => $params['path'],
            'url'       => Config::get('aliyun_url.value', 'upload') . '/' . $params['path'] . '?type=' . self::MODULE,
            'protocol'  => self::MODULE,
            'type'      => $isImage ? 0 : $this->getFileType($params['mime']),
        ];

        if (!empty($params['replace'])) {
            unset($data['parent_id']);
            $data['url'] .= sprintf('&rand=%s', mt_rand(0, time()));
        }

        $map['path'] = ['eq', $data['path']];
        $map['protocol'] = ['eq', self::MODULE];
        $map['type'] = ['neq', 2];

        $storageDb = new Storage();
        $result = $storageDb->where($map)->find();

        if (false === $result) {
            return $this->setError($storageDb->getError());
        }

        if (!is_null($result)) {
            // 替换资源进行更新
            if (false === $result->save($data)) {
                return $this->setError($storageDb->getError());
            }

            $ossResult = $result->setAttr('status', 200)->toArray();
        } else {
            // 插入新记录
            if (false === $storageDb->isUpdate(false)->save($data)) {
                return $this->setError($storageDb->getError());
            }

            $ossResult = $storageDb->setAttr('status', 200)->toArray();
        }

        $ossResult['oss'] = Config::get('oss.value', 'upload');
        return [$ossResult];
    }

    /**
     * 上传资源
     * @access public
     * @return false
     */
    public function uploadFiles()
    {
        // 直传的意思是客户端直接传附件给OSS,而不再需要应用服务端代为上传,少了转发,速度更快.
        return $this->setError('"' . self::NAME . '"只支持直传附件,详见阿里云开发文档');
    }

    /**
     * 获取缩略大小请求参数
     * @access private
     * @param  int    $width  宽度
     * @param  int    $height 高度
     * @param  string $resize 缩放方式
     * @return string
     */
    private function getSizeParam($width, $height, $resize)
    {
        $options = 'resize,';
        if ('proportion' === $resize) {
            $options .= sprintf('p_%d', $width);
        } else {
            $type = 'pad' === $resize ? 'm_pad' : 'm_lfit';
            $options .= $width != 0 ? sprintf('w_%d,', $width) : '';
            $options .= $height != 0 ? sprintf('h_%d,', $height) : '';
            $options .= $type;
        }

        $options .= '/';
        return $options;
    }

    /**
     * 获取裁剪区域请求参数
     * @access private
     * @param  int $width  宽度
     * @param  int $height 高度
     * @return string
     */
    private function getCropParam($width, $height)
    {
        $options = 'crop,';
        $options .= $width != 0 ? sprintf('w_%d,', $width) : '';
        $options .= $height != 0 ? sprintf('h_%d,', $height) : '';
        $options .= 'g_center/';

        return $options;
    }

    /**
     * 获取资源缩略图实际路径
     * @access public
     * @param  array $urlArray 路径结构
     * @return string
     */
    public function getThumbUrl($urlArray)
    {
        // 初始化数据并拼接不带查询条件的URL
        $fileInfo = pathinfo($urlArray['path']);
        $param = $this->request->param();
        $extension = ['jpg', 'png', 'bmp', 'webp', 'gif', 'tiff', 'svg'];

        // 是否带有随机值,用于强制刷新
        $query = [];
        $options = '?x-oss-process=image/';
        if (isset($urlArray['query'])) {
            parse_str($urlArray['query'], $query);
            if (array_key_exists('rand', $query)) {
                $options = sprintf('?rand=%s&x-oss-process=image/', $query['rand']);
            }
        }

        // 实际连接
        $port = isset($urlArray['port']) ? ':' . $urlArray['port'] : '';
        $url = sprintf('%s://%s%s%s', $urlArray['scheme'], $urlArray['host'], $port, $urlArray['path']);

        // 带样式则直接返回
        if (!empty($param['style'])) {
            $style = mb_substr($param['style'], 0, 1, 'utf-8');
            if (in_array($style, ['-', '_', '/', '!'])) {
                $url .= $param['style'];
                if (array_key_exists('rand', $query)) {
                    $url .= sprintf('?rand=%s', $query['rand']);
                }

                return $url;
            }

            $url .= '?x-oss-process=style/' . $param['style'];
            if (array_key_exists('rand', $query)) {
                $url = sprintf('%s?rand=%s&x-oss-process=style/%s', $url, $query['rand'], $param['style']);
            }

            return $url;
        }

        // 非图片资源则直接返回
        if (!in_array(strtolower($fileInfo['extension']), $extension, true)) {
            return $url;
        }

        // 检测尺寸是否正确
        list($sWidth, $sHeight) = @array_pad(isset($param['size']) ? $param['size'] : [], 2, 0);

        // 处理缩放尺寸、裁剪尺寸
        if ($sWidth || $sHeight) {
            foreach ($param as $key => $value) {
                switch ($key) {
                    case 'size':
                        $resize = isset($param['resize']) ? $param['resize'] : '';
                        $options .= $this->getSizeParam($sWidth, $sHeight, $resize);
                        break;

                    case 'crop':
                        list($cWidth, $cHeight) = @array_pad($value, 2, 0);
                        $options .= $this->getCropParam($cWidth, $cHeight);
                        break;
                }
            }
        }

        // 处理图片质量
        if (empty($param['quality'])) {
            $options .= 'quality,Q_100/';
        } else {
            $options .= sprintf('quality,Q_%d/', (int)$param['quality'] > 100 ? 100 : $param['quality']);
        }

        // 处理输出格式
        if (!empty($param['suffix'])) {
            if (in_array($param['suffix'], $extension, true)) {
                $options .= 'format,' . $param['suffix'] . '/';
            }
        }

        // 其余参数添加
        $options .= 'auto-orient,1/interlace,1/';
        return $url . $options;
    }

    /**
     * 批量删除资源
     * @access public
     * @return bool
     */
    public function delFileList()
    {
        if (count($this->delFileList) > 1000) {
            return $this->setError(self::NAME . '批量删除资源不可超过1000个');
        }

        $accessKeyId = Config::get('aliyun_access_key.value', 'upload');
        $accessKeySecret = Config::get('aliyun_secret_key.value', 'upload');
        $endPoint = Config::get('aliyun_endpoint.value', 'upload');
        $bucket = Config::get('aliyun_bucket.value', 'upload');

        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endPoint);
            $ossClient->deleteObjects($bucket, $this->delFileList);
        } catch (OssException $e) {
            return true;
        }

        return true;
    }

    /**
     * 清除缩略图文件夹
     * @access public
     * @param  string $path 路径
     * @return void
     */
    public function clearThumb($path)
    {
        // 暂不需要
    }

    /**
     * 响应实际下载路径
     * @access public
     * @param  string $url      路径
     * @param  string $filename 文件名
     * @return void
     */
    public function getDownload($url, $filename = '')
    {
        // 拆分 URL 链接
        $urlArray = parse_url($url);

        $accessKeyId = Config::get('aliyun_access_key.value', 'upload');
        $accessKeySecret = Config::get('aliyun_secret_key.value', 'upload');
        $endPoint = Config::get('aliyun_endpoint.value', 'upload');
        $bucket = Config::get('aliyun_bucket.value', 'upload');
        $object = mb_substr($urlArray['path'], 1, null, 'UTF-8');
        $timeout = 3600;

        // 请求参数
        $filename = urlencode($filename);
        $filename = str_replace('+', '%20', $filename);
        $options = ['response-content-disposition' => "attachment; filename=\"$filename\""];

        if (isset($urlArray['query'])) {
            $style = str_ireplace('x-oss-process=', '', $urlArray['query']);
            $options[OssClient::OSS_PROCESS] = $style;
        }

        try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endPoint);
            $results = $ossClient->signUrl($bucket, $object, $timeout, OssClient::OSS_HTTP_GET, $options);

            header('Cache-Control: max-age=' . $timeout);
            header('Location:' . $results, true, 301);
        } catch (OssException $e) {
            header('status: 505 HTTP Version Not Supported', true, 505);
        }

        exit();
    }

    /**
     * 获取资源缩略图信息
     * @access public
     * @param  string $url 路径
     * @return array
     */
    public function getThumbInfo($url)
    {
        $info = [
            'size'   => 0,
            'width'  => 0,
            'height' => 0,
        ];

        try {
            $result = Http::httpGet($url);
            list($width, $height) = @getimagesize('data://image/*;base64,' . base64_encode($result));

            if ($width <= 0 || $height <= 0) {
                return $info;
            }

            $info = [
                'size'   => strlen($result) * sizeof($result),
                'width'  => $width,
                'height' => $height,
            ];
        } catch (\Exception $e) {
            return $info;
        }

        return $info;
    }
}
