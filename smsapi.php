<?php

$username = $password = $mobilenumbers = $sendername = $message = $routetype = $postfields = "";

$username = "";
$password = "";
############  For Multiple mobile numbers . send comma seperated 1234567890,9874563210
$mobilenumbers = "";
$sendername = 'INVITE';   //
$message = "Kishore - Need to enable curl in php server to make this code work. ";
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

/*

For semding message Multiple phone number add comma after every phone number.

---  Before sending sms validate phone number ( Minimum 10 digits)
---  $sendername variable should be same as the one in sms appliaction  check screenshot
---  Check attachment of api document for error messages

*/

