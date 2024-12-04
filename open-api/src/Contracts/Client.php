<?php
namespace Lecangs\OpenApi\Contracts;


use Lecangs\OpenApi\Exception\InvalidResponseException;
use Lecangs\OpenApi\Utils\Http;

abstract class Client
{
    /**
     * @var Config 配置
     */
    protected $config;

    /**
     * Client constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param $uri
     * @return string
     */
    protected function getRequestUrl($uri)
    {
        return $this->config->getBaseUri() . $uri;
    }

    /**
     * @param Request $request
     * @return array|mixed
     * @throws InvalidResponseException
     */
    protected function doRequest(Request $request)
    {
        $request->setHeaders($this->config->getConfig());
        $request->validate();
        $method = $request->getMethod();
        $headers = $request->getHeaders();
        $dataType = $request->getDataType();
        $body = $request->getBody();
        $url = $this->getRequestUrl($request->getApiUri());

        if (strtolower($method) == 'get' && !empty($body)) {
            $url .= (stripos($url, '?') !== false ? '&' : '?') . http_build_query($body);
        }
        $headers = $dataType == 'JSON' ?
            array_merge($headers, ['Content-Type: application/json;charset=UTF-8']) :
            array_merge($headers, ['Content-Type: application/x-www-form-urlencoded;charset=UTF-8']
            );
        $body = $dataType == 'JSON' ? json_encode($body) : $body;
        try {
            return Http::request($method, $url, $body, $headers);
        } catch (\Exception $e) {
            throw new InvalidResponseException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
