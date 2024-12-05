# Lecangs Open API SDK for PHP

乐歌海外仓 Open API PHP SDK 提供了一套简单的方式来调用乐歌 OMS 系统 API，支持查询库存、订单管理等功能。

## 环境要求

- PHP 版本要求：**7.0 或更高版本**
- Composer 包管理工具

## 安装

使用 Composer 安装：

```bash
composer require lecangs/open-api
```
## 参考文档

更多接口详情，请参考乐歌海外仓官方 API 文档：[乐歌海外仓 API 文档](https://app.lecangs.com/wiki?systemType=OMS_CLIENT&id=37)

# 使用示例

以下示例展示如何通过 SDK 调用库存分页查询接口。

```php
use Lecangs\OpenApi\Contracts\Config;
use Lecangs\OpenApi\System\Request\AppUnityRequest;
use Lecangs\OpenApi\Lecangs;
use Lecangs\OpenApi\Constants\ApiUri;

try {
    // 配置访问凭证
    $config = new Config();
    $config->setAccessKey('Your-AccessKey')
           ->setSecretKey('Your-SecretKey')
           ->setIsDev();  // 设置为开发环境，可根据需要调整

    // 请求体
    $body = [
        'pageNum' => '1',
    ];

    // 创建请求实例
    $request = new AppUnityRequest();
    $request->setMethod('post')
            ->setApiUri(ApiUri::INVENTORY_OVERVIEW)
            ->setBody($body);

    // 发起请求并获取响应
    $response = Lecangs::system($config)->appUnity($request);

    // 输出响应结果
    var_dump($response->getData());  // 返回的数据
    var_dump($response->getCode());  // 响应码
    var_dump($response->getMessage());  // 响应消息
} catch (\Exception $e) {
    // 处理异常
    var_dump($e->getMessage());
}
```
## 常量说明
ApiUri 类中定义了多个可用的 API 地址常量，用于不同的业务场景。

# 示例常量
```php
namespace Lecangs\OpenApi\Constants;

class ApiUri {
    const INVENTORY_OVERVIEW = '/oms/inventoryOverview/apiPage';  // 分页查询库存
    const TOC_ORDER_LIST = '/oms/omsTocOrder/listByOrderNos';     // 查询 2C 订单列表
    const CREATE_TOC_ORDER = '/oms/omsTocOrder/create';           // 创建 2C 订单
    const CANCEL_TOC_ORDER = '/oms/omsTocOrder/cancel';           // 取消 2C 订单
}
```
## 反馈和支持

如有任何问题或建议，请联系 SDK 维护者或提交 issue。

# 许可证

本项目遵循 MIT 许可证。详细信息请查阅 LICENSE 文件。