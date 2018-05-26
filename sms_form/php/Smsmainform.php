<?php
session_start();
date_default_timezone_set('PRC');

$opType = $_GET['opType'];
//echo $opType;
ini_set("display_errors", "on");

require_once dirname(__DIR__) . '..\..\aliyun-dysms-php-sdk\api_sdk\vendor\autoload.php';

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

// 加载区域结点配置
Config::load();

$acsClient = null;

/**
 * 取得AcsClient
 *
 * @return DefaultAcsClient
 */
function getAcsClient() {
    //产品名称:云通信流量服务API产品,开发者无需替换
    $product = "Dysmsapi";

    //产品域名,开发者无需替换
    $domain = "dysmsapi.aliyuncs.com";

    // TODO 此处需要替换成开发者自己的AK (https://ak-console.aliyun.com/)
    $accessKeyId = "LTAI5IidniBGBwVw"; // AccessKeyId

    $accessKeySecret = "KyYmb8vvPvMjtW5qu8KKnUtykZysmE"; // AccessKeySecret

    // 暂时不支持多Region
    $region = "cn-hangzhou";

    // 服务结点
    $endPointName = "cn-hangzhou";

    global $acsClient;
    if($acsClient == null) {

        //初始化acsClient,暂不支持region化
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

        // 增加服务结点
        DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

        // 初始化AcsClient用于发起请求
        $acsClient = new DefaultAcsClient($profile);
    }
    return $acsClient;
}

if($opType == 1){
    $request = new SendSmsRequest();
    //可选-启用https协议
    //$request->setProtocol("https");

    // 必填，设置短信接收号码
//    static $globalPhone;
    $globalPhone =  $_GET['mobile'];
    $request->setPhoneNumbers($globalPhone);
    $_SESSION['mobile'] = $globalPhone;
    // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
    $request->setSignName("青科融创");

    // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
    $request->setTemplateCode("SMS_127185088");

    // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
//    static $globalVerifiedCode;
    $verifiedCode = rand(1000,9999);
    $globalVerifiedCode = strval($verifiedCode);
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
        "code"=>$globalVerifiedCode,
    ), JSON_UNESCAPED_UNICODE));
    $_SESSION['verifiedCode'] = $globalVerifiedCode;

    // 可选，设置流水号
    $request->setOutId("yourOutId");

    // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
    $request->setSmsUpExtendCode("1234567");

    // 发起访问请求
    $acsResponse = getAcsClient()->getAcsResponse($request);
    echo  "Type1 ",'$globalVerifiedCode:',$globalVerifiedCode,'$globalPhone:',$globalPhone;
}elseif ($opType == 2){
    if($_SESSION['verifiedCode'] == null or $_SESSION['mobile'] == null){
        echo "没有填写手机号或验证码！";
    }

    $v = $_SESSION['verifiedCode'];
    $m = $_SESSION['mobile'];

    $input_verifiedCode = $_GET['code'];
    $input_mobile = $_GET['mobile'];

//    echo  "Type2 ",'$globalVerifiedCode:',$v,'$globalPhone:',$m;
//    echo  "Type2 ",'$globalVerifiedCode:',$input_verifiedCode,'$globalPhone:',$input_mobile;

    if($v == $input_verifiedCode and $m == $input_mobile){
        echo "success";
    }else{
        echo "failed";
    }

}
?>