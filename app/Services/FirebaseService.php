<?php

namespace App\Services;

class FirebaseService
{
    public function fillAndroidJson($data)
    {
        $json =  array();
        $json['title'] = $data['title'];
        $json['body'] = $data['message'];
        $json['type'] = intval($data['type']);
        $json['id'] = intval($data['order']);
        $json['searchKey'] = $data['searchKey'];
        return $json;
    }

    public function fillIOSJson($title,$body)
    {
        $json['title'] = $title;
        $json['body'] = $body;
        $json['sound'] = 'default';
        return $json;
    }

    public function sendAndroidNotification($tokens,$json)
    {
        if (is_array($tokens))
            $tokenIds = $tokens;
        else
            $tokenIds = [$tokens];

        define('SERVER_KEY', 'AAAAQnE4CLg:APA91bGE2Q1ss-OVWajz33JUlC7nM0f4FrybgqW2WY1kMMhzdHr5x5a0woTAnSdrlvSOs6Cpkuw5C8VOFG6MvFsHe4HFAddW9OAE9SYnx1v6pO0Te6EZLoZCQ9ruj9B69duyrYJC170W' );

        $fields = array
        (
            'registration_ids'  => $tokenIds,
            'data' => $json
        );

        $headers = array
        (
            'Authorization: key=' . SERVER_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch );

        if ($result === FALSE)
        {
            die('FCM Send Error: ' . curl_error($ch));
        }

        $result = json_decode($result,true);
        curl_close( $ch );

        $response['firebase'] = $result;
        $response['json'] = $fields;
        return $response;
    }

    public function sendIOSNotification($tokens,$json,$data)
    {
        if (is_array($tokens))
            $tokenIds = $tokens;
        else
            $tokenIds = [$tokens];

        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AAAAQnE4CLg:APA91bGE2Q1ss-OVWajz33JUlC7nM0f4FrybgqW2WY1kMMhzdHr5x5a0woTAnSdrlvSOs6Cpkuw5C8VOFG6MvFsHe4HFAddW9OAE9SYnx1v6pO0Te6EZLoZCQ9ruj9B69duyrYJC170W';
        $arrayToSend = array('content_available' => true, 'registration_ids' => $tokenIds,'data' => $data,'notification' => $json,'priority'=>'high');
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayToSend));
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Send the request
        $result = curl_exec($ch);
        if ($result === FALSE)
        {
            die('FCM Send Error: ' . curl_error($ch));
        }
        $result = json_decode($result,true);
        //Close request
        curl_close($ch);
        $response['firebase'] = $result;
        $response['json'] = $arrayToSend;
        return $response;
        //return $result;
    }

    public function sendNotification($data, $notification, $userToken, $deviceType)
    {
        if ($deviceType == 'IOS') {
            $json = $this->fillIOSJson($notification['title'], $notification['body']);
            $this->sendIOSNotification($userToken, $json, $data);
        } else {
            $this->sendAndroidNotification($data, $userToken);
        }
    }
}
