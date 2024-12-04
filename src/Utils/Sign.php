<?php
namespace Lecangs\OpenApi\Utils;
class Sign {
    /**
     * 生成签名
     * 
     * @param string $accessKey
     * @param string $timestamp
     * @param string $secretKey
     * @param string|null $body
     * @return string
     */
    public static function make($timestamp,string $accessKey, string $secretKey, array $body = [])
    {
        $body['timestamp'] = $timestamp;
        $body['accessKey'] = $accessKey;
        ksort($body);
        $plainText = '';
        foreach ($body as $key => $value) {
            if ($key === 'sign') {
                continue;
            }
            $valueStr = is_array($value) ? json_encode($value) : $value;
            $plainText .= "$key=$valueStr&";
        }
        $plainText = rtrim($plainText, '&') . $secretKey;
        return hash('sha256', $plainText);
    }
}