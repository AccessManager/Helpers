<?php

namespace AccessManager\Helpers\Libraries\SMS;


class MSG91SMS extends SMS
{
    protected function postToGateway()
    {
        $authkey = config('sms.msg91.key');

        $ch = curl_init(config('sms.msg91.url'));

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => "",
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => "POST",
            CURLOPT_POSTFIELDS      => $this->_preparePostFields(),
            CURLOPT_SSL_VERIFYHOST  => 0,
            CURLOPT_SSL_VERIFYPEER  => 0,
            CURLOPT_HTTPHEADER      => [
                "authkey: $authkey",
                "content-type: application/json"
            ]
        ]);

        $response = curl_exec($ch);

        curl_close($ch);
        echo $response;
    }

    private function _preparePostFields()
    {
        $senderid = config('sms.msg91.senderid');
        $message = $this->message;
        $number = $this->number;

        return "{ \"sender\": \"{$senderid}\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"$message\", \"to\": [ \"$number\"] } ]}";
    }

}