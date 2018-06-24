<?php

namespace AccessManager\Helpers\Libraries\SMS;


class MSG91OTP extends SMS
{
    public function postToGateway()
    {
        $authkey = config('sms.msg91.key');
        $curl = curl_init();
//        echo "OTP is: {$this->otp}";
//        echo $this->message;
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?template=&authkey={$authkey}&otp={$this->otp}&message={$this->message}&sender=ESTOIN&mobile={$this->number}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
//        echo $response;
        echo $err;
    }
}