<?php

namespace AccessManager\Helpers;

/**
 * This trait is used to get & confirm password in artisan console command.
 *
 * Class GetConsolePasswordTrait
 * @package AccessManager\Helpers
 */
trait GetConsolePasswordTrait
{
    /**
     * after validation confirm the password.
     *
     * @return mixed
     */
    protected function getConfirmedPassword()
    {
        $newPassword = $this->getNewPassword();
        $confirmPassword = $this->secret("confirm new password");

        while( $newPassword != $confirmPassword )
        {
            $this->error("password did not match, try again..");
            $newPassword = $this->secret("new password");
            $confirmPassword = $this->secret("confirm new password");
        }

        return $newPassword;
    }

    /**
     * get a new valid password from console.
     *
     * @return mixed
     */
    protected function getNewPassword()
    {
        $newPassword = $this->secret("new password");

        while( $this->isInvalidPassword($newPassword) )
        {
            $this->error("password should not contain spaces.");
            $newPassword = $this->secret("new password");
        }

        return $newPassword;
    }

    /**
     * check if password is valid.
     *
     * @param $password
     * @return bool|int
     */
    protected function isInvalidPassword( $password )
    {
        $password = trim($password);
        return strpos( $password, ' ');
    }
}