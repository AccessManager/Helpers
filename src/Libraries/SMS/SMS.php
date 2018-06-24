<?php

namespace AccessManager\Helpers\Libraries\SMS;


abstract class SMS
{
    protected $number;

    protected $message;

    protected $otp;

    public function send()
    {
        $this->postToGateway();
    }

    abstract protected function postToGateway();


    public function setMessage( $txt )
    {
        $this->message = urlencode($txt);
    }

    public function __construct( $number, $otp )
    {
        $this->number = '91' . $number;
        $this->otp = $otp;
    }
}