环境要求
php:7.0 || 8.0

# 使用示例
composer require lecangs/open-api

```php
use Lecangs\OpenApi\Contracts\Config;
use Lecangs\OpenApi\System\Request\AppUnityRequest;
use Lecangs\OpenApi\Lecangs;

try {
  $config = new Config();
  $config->setAccessKey('Your-AccessKey');
  $config->setSecretKey('Your-SecretKey');
  $body = [
    'pageNum'=> '1'
  ];
  $request = new AppUnityRequest();
  $request ->setMethod('post')
           ->setApiUri('/oms/inventoryOverview/apiPage')
           ->setBody($body);
  $response = Lecangs::system($config)->appUnity($request);
  var_dump($response->getData());
  var_dump($response->getCode());
  var_dump($response->getMessage());
} catch (\Exception $e) {
  var_dump($e->getMessage());
}