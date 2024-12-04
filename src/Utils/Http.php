<?php

namespace Lecangs\OpenApi\Utils;

class Http
{
    /**
     *
     * @param $method
     * @param $url
     * @param array $body
     * @param array $headers
     * @param int $timeout
     * @return array|mixed
     */
    public static function request($method, $url, $body = [], $headers = [], $timeout = 60)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);

        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if (strtolower($method) == 'post') {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $tmpInfo = curl_exec($curl);
        if (curl_errno($curl)) {
            $tmpInfo = curl_error($curl);
        }
        curl_close($curl);
        $tmpInfo = json_decode($tmpInfo, true);
        return $tmpInfo ?: [];
    }
}
