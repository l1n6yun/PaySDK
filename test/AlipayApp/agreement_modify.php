<?php
/**
 * 支付宝个人协议页面签约Demo.
 */

use Yurun\PaySDK\AlipayApp\Agreement\Params\Sign\Request;
use Yurun\PaySDK\AlipayApp\SDK;

require __DIR__ . '/common.php';

// 公共配置
$params = new \Yurun\PaySDK\AlipayApp\Params\PublicParams();
$params->appID = $GLOBALS['PAY_CONFIG']['appid'];
//$params->sign_type = 'RSA2'; // 默认就是RSA2
$params->appPrivateKey = $GLOBALS['PAY_CONFIG']['privateKey'];
// $params->appPrivateKeyFile = ''; // 证书文件，如果设置则这个优先使用
$params->apiDomain = 'https://openapi.alipaydev.com/gateway.do'; // 设为沙箱环境，如正式环境请把这行注释

// SDK实例化，传入公共配置
$pay = new \Yurun\PaySDK\AlipayApp\SDK($params);

// 支付接口
$request = new \Yurun\PaySDK\AlipayApp\Agreement\Params\Modify\Request();
$request->businessParams->agreement_no = '20185909000458725113';
$request->businessParams->deduct_time = date('Y-m-d', strtotime('+1 day'));
$request->businessParams->memo = '用户已购买半年包，需延期扣款时间';

// 调用接口
$result = $pay->execute($request);

var_dump('result:', $result);

var_dump('success:', $pay->checkResult());

var_dump('error:', $pay->getError(), 'error_code:', $pay->getErrorCode());
