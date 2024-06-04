<?php

use Illuminate\Support\Facades\Http;

function sendSMS($to, $otp)
{ 
    $hashcode = bin2hex(random_bytes(6));
    $url = "https://www.smsalert.co.in/api/push.json?apikey=XXXXXXXX&route=transactional&sender=DOLING&mobileno=".$to."&text=".$otp."%20is%20your%20One-Time-Password%20_OTP_%20to%20Register%20at%20Doling%20Deals%20account.%20".$hashcode."%20Regards,%20XXXX%20It%20XXXX";    
    $response = Http::post($url);
    return $response;
}