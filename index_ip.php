<?php

$username = $password = $mobilenumbers = $sendername = $message = $routetype = $postfields = "";


$username = "";
$password = "";
############  For Multiple mobile numbers . send comma seperated 1234567890,9874563210
$mobilenumbers = "9989885814";
$sendername = 'INVITE';   //
$message = "Api test";
$routetype = 0; //0-promotional;1-Transactional;2-Promo with Sender ID
$datetime = "";


if ($datetime == "") {
    $postfields = "username=" . $username . "&password=" . $password . "&mobile=" . $mobilenumbers . "&sendername=" . $sendername . "&message=" . $message . "&routetype=" . $routetype . "";
}

if ($datetime != "") {
    if (is_numeric(strtotime($datetime))) {
        $postfields = "username=" . $username . "&password=" . $password . "&mobile=" . $mobilenumbers . "&sendername=" . $sendername . "&message=" . $message . "&routetype=" . $routetype . "&datetime=" . $datetime . "";
    }

}
$curl_url = "http://mahaoffers.in/SMS_API/sendsms.php";
$ch_sms = curl_init();
curl_setopt($ch_sms, CURLOPT_URL, $curl_url);
curl_setopt($ch_sms, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_sms, CURLOPT_HEADER, false);
curl_setopt($ch_sms, CURLOPT_POST, true);
curl_setopt($ch_sms, CURLOPT_POSTFIELDS, $postfields);
$response = curl_exec($ch_sms);
curl_close($ch_sms);
print_r($response);
exit;


echo phpinfo();
exit;
for ($i = 0; $i < 1000; $i++) {
    $curl_url = "http://10.10.10.84/VendorLynx_Dev/";
    //$curl_url = "https://dev.globaledgegateway.com/vendorlynx/";
    $ch_sms = curl_init();
    curl_setopt($ch_sms, CURLOPT_URL, $curl_url);
    curl_setopt($ch_sms, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_sms, CURLOPT_HEADER, false);
    //curl_setopt($ch_sms, CURLOPT_POST, true);
    //curl_setopt($ch_sms, CURLOPT_POSTFIELDS, $input_xml);
    //curl_setopt($ch_sms, CURLOPT_HTTPHEADER, $sms_header);
    $response = curl_exec($ch_sms);
    curl_close($ch_sms);
    //echo $response;
}