<?php

namespace App\Services;

class SmsService
{
    public  function sendSMS($phone, $text, $lang = 'e')
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('post', 'https://smsvas.vlserv.com/KannelSending/service.asmx/SendSMS'
                , [
                    'content-type' => 'application/x-www-form-urlencoded',
                    'form_params' => [
                        'Username' => config('sms.username'),
                        'Password' => config('sms.password'),
                        'SMSText' => $text,
                        'SMSLang' => $lang,
                        'SMSSender' => 'Kheir',
                        'SMSReceiver' => $phone,

                    ]
                ]
            );

            $body = (string)$response->getBody();
            $result = '';
            for ($i = 0; $i < strlen($body); $i++) {
                if ($body[$i - 1] . $body[$i] == '">') {
                    for ($j = $i + 1; $j < strlen($body); $j++) {
                        if ($body[$j] == "<")
                            break;
                        $result .= $body[$j];
                    }
                    break;
                }
            }
            return $result;

        } catch (\Exception $e) {
            return '-1';
        }
    }

}
