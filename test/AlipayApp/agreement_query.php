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
$request = new \Yurun\PaySDK\AlipayApp\Agreement\Params\Query\Request();
$request->businessParams->alipay_open_id = '074a1CcTG1LelxKe4xQC0zgNdId0nxi95b5lsNpazWYoCo5';
$request->businessParams->agreement_no = '20170322450983769228';

// 调用接口
$result = $pay->execute($request);

var_dump('result:', $result);

var_dump('success:', $pay->checkResult());

var_dump('error:', $pay->getError(), 'error_code:', $pay->getErrorCode());
