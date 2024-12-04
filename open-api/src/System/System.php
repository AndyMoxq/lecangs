<?php

namespace Lecangs\OpenApi\System;

use Lecangs\OpenApi\Contracts\Config;
use Lecangs\OpenApi\Contracts\Client;
use Lecangs\OpenApi\System\Request\AppUnityRequest;
use Lecangs\OpenApi\System\Response\AppUnityResponse;

class System extends Client
{
    /**
     * @var Config|null 配置对象
     */
    protected $config;

    /**
     * 构造函数
     * 
     * @param Config|null $config 配置对象
     */
    public function __construct(Config $config = null)
    {
        $this->config = $config;
    }

    /**
     * 执行 AppUnity 请求
     * 
     * @param AppUnityRequest $request 请求对象
     * @return AppUnityResponse 格式化后的响应对象
     */
    public function appUnity(AppUnityRequest $request)
    {
        return AppUnityResponse::format($this->doRequest($request));
    }
}