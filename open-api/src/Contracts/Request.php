<?php

namespace Lecangs\OpenApi\Contracts;

use Lecangs\OpenApi\Exception\ValidateRequestException;

abstract class Request
{
    /**
     * @var array 请求头
     */
    protected $headers = [];

    /**
     * @var array 请求体
     */
    protected $body = [];

    /**
     * @var string 请求方式
     */
    protected $method;

    /**
     * @var string 请求数据格式
     */
    protected $dataType = 'JSON';

    /**
     * @var string 接口地址
     */
    protected $apiUri = '';

    /**
     * 获取请求头
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * 获取请求体
     *
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * 获取数据格式
     *
     * @return string
     */
    public function getDataType(): string
    {
        return $this->dataType;
    }

    /**
     * 获取接口地址
     *
     * @return string
     */
    public function getApiUri(): string
    {
        return $this->apiUri;
    }

    /**
     * 获取请求方式
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * 设置请求方式
     *
     * @param string $method
     * @return $this
     * @throws ValidateRequestException
     */
    public function setMethod(string $method): self
    {
        $method = strtoupper($method);
        if (!in_array($method, ['POST', 'GET'])) {
            throw new ValidateRequestException('method must be GET or POST');
        }
        $this->method = $method;
        return $this;
    }

    /**
     * 合并配置到请求体中
     *
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config): self
    {
        $this->body = array_merge($this->body, $config);
        return $this;
    }

    /**
     * 验证字段是否为必填
     *
     * @param string $fieldName
     * @param mixed $field
     * @param bool|null $val
     * @throws ValidateRequestException
     */
    public function validateRequired(string $fieldName, $field, bool $val = null): void
    {
        if ($val === true && $field === null) {
            throw new ValidateRequestException("$fieldName is required");
        }
    }

    /**
     * 验证字段最大长度
     *
     * @param string $fieldName
     * @param mixed $field
     * @param int|null $val
     * @throws ValidateRequestException
     */
    public function validateMaxLength(string $fieldName, $field, int $val = null): void
    {
        if ($field !== null && strlen($field) > $val) {
            throw new ValidateRequestException("$fieldName exceeds max-length: $val");
        }
    }

    /**
     * 验证字段最小长度
     *
     * @param string $fieldName
     * @param mixed $field
     * @param int|null $val
     * @throws ValidateRequestException
     */
    public function validateMinLength(string $fieldName, $field, int $val = null): void
    {
        if ($field !== null && strlen($field) < $val) {
            throw new ValidateRequestException("$fieldName is less than min-length: $val");
        }
    }

    /**
     * 验证字段是否匹配正则
     *
     * @param string $fieldName
     * @param mixed $field
     * @param string $regex
     * @throws ValidateRequestException
     */
    public function validatePattern(string $fieldName, $field, string $regex = ''): void
    {
        if ($field !== null && $field !== '' && !preg_match("/^{$regex}$/", $field)) {
            throw new ValidateRequestException("$fieldName does not match $regex");
        }
    }

    /**
     * 验证字段是否小于或等于最大值
     *
     * @param string $fieldName
     * @param mixed $field
     * @param mixed $val
     * @throws ValidateRequestException
     */
    public static function validateMaximum(string $fieldName, $field, $val): void
    {
        if ($field !== null && $field > $val) {
            throw new ValidateRequestException("$fieldName cannot be greater than $val");
        }
    }

    /**
     * 验证字段是否大于或等于最小值
     *
     * @param string $fieldName
     * @param mixed $field
     * @param mixed $val
     * @throws ValidateRequestException
     */
    public function validateMinimum(string $fieldName, $field, $val): void
    {
        if ($field !== null && $field < $val) {
            throw new ValidateRequestException("$fieldName cannot be less than $val");
        }
    }

    /**
     * 抽象方法：验证请求数据
     *
     * @return mixed
     */
    abstract public function validate();
}