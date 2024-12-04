<?php

namespace Lecangs\OpenApi\System\Request;

use Lecangs\OpenApi\Contracts\Request;
use Lecangs\OpenApi\Exception\ValidateRequestException;
use Lecangs\OpenApi\Utils\Sign;

class AppUnityRequest extends Request
{
    /**
     * @var string API URI 地址
     */
    protected $apiUri;

    /**
     * AppUnityRequest 构造函数
     */
    public function __construct()
    {
        // $this->headers['timestamp'] = time() * 1000;
    }

    /**
     * 设置请求头部信息
     *
     * @param array $config 配置数组，包含 accessKey 和 secretKey
     * @throws ValidateRequestException
     */
    public function setHeaders(array $config): void
    {
        $timestamp = time() * 1000;

        if (!isset($config['accessKey'])) {
            throw new ValidateRequestException('accessKey不能为空');
        }

        if (!isset($config['secretKey'])) {
            throw new ValidateRequestException('secretKey不能为空');
        }

        $this->headers[] = "timestamp:$timestamp";
        $this->headers[] = 'accessKey:' . $config['accessKey'];
        $this->headers[] = 'sign:' . Sign::make(
            $timestamp,
            $config['accessKey'],
            $config['secretKey'],
            $this->body
        );
    }

    /**
     * 设置 API URI
     *
     * @param string $apiUri API URI 地址
     * @return self
     */
    public function setApiUri(string $apiUri): self
    {
        $this->apiUri = $apiUri;
        return $this;
    }

    /**
     * 设置请求体
     *
     * @param array $body 请求体内容
     */
    public function setBody(array $body): void
    {
        $this->body = $body;
    }

    /**
     * 验证请求的完整性
     *
     * @throws ValidateRequestException
     */
    public function validate(): void
    {
        if (!isset($this->apiUri)) {
            throw new ValidateRequestException('api端点不能为空');
        }

        if (!isset($this->method)) {
            throw new ValidateRequestException('method不能为空');
        }
    }
}