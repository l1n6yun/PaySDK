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
$request = new \Yurun\PaySDK\AlipayApp\Agreement\Params\Sign\Request();
$request->notify_url = $GLOBALS['PAY_CONFIG']['notify_url']; // 支付后通知地址（作为支付成功回调，这个可靠）
$request->businessParams->product_code = 'GENERAL_WITHHOLDING';
$request->businessParams->personal_product_code = 'CYCLE_PAY_AUTH_P';
$request->businessParams->sign_scene = 'INDUSTRY|DEFAULT_SCENE';
$request->businessParams->external_agreement_no = 'test' . mt_rand(10000000, 99999999); // 商户签约号;
$request->businessParams->access_params = ['channel' => 'ALIPAYAPP'];
$request->businessParams->period_rule_params = [
    'period_type' => "DAY",
    'period' => 30,
    'execute_time' => date('Y-m-d'),
    'single_amount' => "29.9",
    'total_amount' => "5000",
    'total_payments' => "999",
];
$request->businessParams->external_logon_id = $params['mobile'];

// 处理
$pay->prepareExecute($request, $url, $data);

$payUrl = 'alipays://platformapi/startapp?' . http_build_query([
        'appId' => 60000157,
        'appClearTop' => 'false',
        'startMultApp' => 'YES',
        'sign_params' => http_build_query($data)
    ]);

echo $payUrl;
