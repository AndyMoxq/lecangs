<?php
namespace Lecangs\OpenApi;
use Lecangs\OpenApi\Contracts\Config;

class Lecangs
{
    /**
     * 创建模块实例
     * @param string $name 模块名（如 system、order）
     * @param Config|null $config 配置信息
     * @return mixed
     */
    public static function make($name, Config $config = null)
    {
        $clientClass = sprintf('\\Lecangs\\OpenApi\\%s\\%s', ucfirst($name), ucfirst($name));

        if (!class_exists($clientClass)) {
            throw new \InvalidArgumentException("Module [$name] does not exist.");
        }

        return new $clientClass($config);
    }

    /**
     * 静态调用方法，用于便捷创建模块实例
     * @param string $name 模块名
     * @param array $arguments 参数数组
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}