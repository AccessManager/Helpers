<?php

namespace AccessManager\Helpers\Libraries\SMS;


class SMSBINSMS extends SMS
{

     protected function postToGateway()
    {
        $ch = curl_init(config('sms.smsbin.url'));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER  =>  1,
            CURLOPT_POST            =>  1,
            CURLOPT_POSTFIELDS      =>  $this->_prepareQueryString(),
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
    }
    
    private function _prepareQueryString()
    {
        return   http_build_query([
                    'key'       =>  config('sms.smsbin.key'),
                    'campaign'  =>  0,
                    'routeid'   =>  config('sms.smsbin.routeid'),
                    'type'      =>  'text',
                    'contacts'  =>  $this->number,
                    'senderid'  =>  config('sms.smsbin.senderid'),
                    'msg'       =>  $this->message,
                ]);
    }

 }