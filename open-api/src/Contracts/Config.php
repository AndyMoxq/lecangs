<?php

namespace Lecangs\OpenApi\Contracts;

class Config implements \ArrayAccess
{
    /**
     * @var string URI地址
     */
    private $baseUri = 'https://app.lecangs.com/api';

    /**
     * 当前配置值
     *
     * @var array
     */
    protected $config = [];

    /**
     * Config 构造函数.
     *
     * @param array $options 初始化配置项
     */
    public function __construct(array $options = [])
    {
        foreach ($options as $key => $option) {
            $this->config[$key] = $option;
        }
    }

    /**
     * 获取基础 URI 地址
     *
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * 设置基础 URI 地址
     *
     * @param string $baseUri
     * @return self
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    /**
     * 获取 accessKey
     *
     * @return string|null
     */
    public function getAccessKey(): ?string
    {
        return $this->config['accessKey'] ?? null;
    }

    /**
     * 设置 accessKey
     *
     * @param string $accessKey
     * @return self
     */
    public function setAccessKey(string $accessKey): self
    {
        $this->config['accessKey'] = $accessKey;
        return $this;
    }

    /**
     * 获取 secretKey
     *
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->config['secretKey'] ?? '';
    }

    /**
     * 设置 secretKey
     *
     * @param string $secretKey
     * @return self
     */
    public function setSecretKey(string $secretKey): self
    {
        $this->config['secretKey'] = $secretKey;
        return $this;
    }

    /**
     * 设置为开发环境并修改 baseUri
     *
     * @return self
     */
    public function setIsDev(): self
    {
        $this->baseUri = 'https://apprelease.lecangs.com/api';
        return $this;
    }

    /**
     * 获取当前配置数组
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * 设置配置项
     *
     * @param string $offset
     * @param mixed $value
     */
    public function set(string $offset, mixed $value): void
    {
        $this->offsetSet($offset, $value);
    }

    /**
     * 获取配置项
     *
     * @param string|null $offset
     * @return mixed|null
     */
    public function get(?string $offset = null): mixed
    {
        return $this->offsetGet($offset);
    }

    /**
     * 合并配置数据
     *
     * @param array $data
     * @param bool $append 是否追加
     * @return array
     */
    public function merge(array $data, bool $append = false): array
    {
        if ($append) {
            $this->config = array_merge($this->config, $data);
        }
        return array_merge($this->config, $data);
    }

    /**
     * 设置数组元素
     *
     * @param string|null $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->config[] = $value;
        } else {
            $this->config[$offset] = $value;
        }
    }

    /**
     * 检查数组元素是否存在
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->config[$offset]);
    }

    /**
     * 删除数组元素
     *
     * @param string|null $offset
     */
    public function offsetUnset($offset = null): void
    {
        if (is_null($offset)) {
            $this->config = [];
        } else {
            unset($this->config[$offset]);
        }
    }

    /**
     * 获取数组元素
     *
     * @param string|null $offset
     * @return mixed|null
     */
    public function offsetGet($offset = null): mixed
    {
        return is_null($offset) ? $this->config : ($this->config[$offset] ?? null);
    }
}