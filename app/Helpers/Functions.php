<?php
namespace App\Helpers;


use App\Models\Notification;

class Functions
{
    public static function SendNotification($user, $title, $msg, $ref_id = null, $type = 0, $store = true, $replace = [])
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $registrationIds = $user->device_token;

        $message = array
        (
            'body' => $msg,
            'title' => $title,
            'sound' => true,
        );
        $extraNotificationData = ["ref_id" => $ref_id, "type" => $type];
        $fields = array
        (
            'to' => $registrationIds,
            'notification' => $message,
            'data' => $extraNotificationData
        );
        $headers = array
        (
            'Authorization: key=' . config('app.notification_key'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        if ($store) {
            $notify = new Notification();
            $notify->type = $type;
            $notify->user_id = $user->id;
            $notify->title = $title;
            $notify->message = $msg;
            $notify->ref_id = @$ref_id;
            $notify->save();
        }
        return true;
    }

    public static function SendNotifications($users, $title, $msg,$target_type,$ref_type,$ref_id = null,$replace = [])
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $registrationIds = $users;

        $message = array
        (
            'body' => $msg,
            'title' => $title,
            'sound' => true,
        );
        $extraNotificationData = ["ref_id" => $ref_id, "ref_type" => $ref_type, "target_type" => $target_type];
        $fields = array
        (
            'registration_ids' => $registrationIds,
            'notification' => $message,
            'data' => $extraNotificationData
        );
        $headers = array
        (
            'Authorization: key=' . config('app.notification_key'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }
}
