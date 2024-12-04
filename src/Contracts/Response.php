<?php

namespace Lecangs\OpenApi\Contracts;

use Lecangs\OpenApi\Exception\ValidateResponseException;

class Response
{
    /**
     * @var array 响应体默认结构
     */
    protected $body = [
        'code' => 0,
        'success' => false,
        'message' => '',
        'data' => null,
    ];

    /**
     * 获取响应码
     *
     * @return int
     */
    public function getCode(): int
    {
        return $this->body['code'] ?? 0;
    }

    /**
     * 设置响应码
     *
     * @param int $code
     * @return $this
     */
    public function setCode(int $code): self
    {
        $this->body['code'] = $code;
        return $this;
    }

    /**
     * 获取消息内容
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->body['message'] ?? '';
    }

    /**
     * 设置消息内容
     *
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->body['message'] = $message;
        return $this;
    }

    /**
     * 获取数据
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->body['data'] ?? [];
    }

    /**
     * 设置数据
     *
     * @param mixed $data
     * @return $this
     */
    public function setData($data): self
    {
        $this->body['data'] = $data;
        return $this;
    }

    /**
     * 设置整个响应体
     *
     * @param array $body
     * @return $this
     */
    public function setBody(array $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * 获取整个响应体
     *
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * 格式化响应体并验证
     *
     * @param array $responseBody
     * @return static
     */
    public static function format(array $responseBody = []): self
    {
        $response = new static();
        $response->setBody($responseBody);
        $response->validate();
        return $response;
    }

    /**
     * 验证响应体数据是否有效
     *
     * @throws ValidateResponseException
     */
    public function validate(): void
    {
        if ($this->getCode() != 200 && !($this->getBody()['success'] ?? '')) {
            if (isset($this->getBody()['code']) && $this->getBody()['code'] !== '') {
                $this->setCode($this->getBody()['code']);
                $message = $this->getBody()['message'];
                if (is_string($this->getBody()['data'] ?? '')) {
                    $message .= $this->getBody()['data'] ?? '';
                }
                $this->setMessage($message);
            }

            $errorMessage = '【' . $this->getCode() . '】' . $this->getMessage();
            throw new ValidateResponseException($errorMessage);
        }
    }
}