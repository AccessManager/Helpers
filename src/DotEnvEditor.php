<?php

namespace AccessManager\Helpers;


use function Stringy\create as S;

/**
 * Class DotEnvEditor
 * @package AccessManager\Helpers
 */
class DotEnvEditor
{
    /**
     * path to .env file.
     *
     * @var
     */
    private $pathToFile;

    /**
     * content of the .env file.
     *
     * @var string
     */
    private $content;

    /**
     * @param string $host
     * @return $this
     */
    public function setDbHost( $host = '127.0.0.1' )
    {
        $currentValue = "DB_HOST=" . env('DB_HOST');
        $newValue = "DB_HOST=$host";
        $this->content = S($this->content)->replace($currentValue, $newValue);
        config('database.connections.mysql.host', $host);

        return $this;
    }

    /**
     * @param string $database
     * @return $this
     */
    public function setDbDatabase( $database = 'acmanager' )
    {
        $currentValue = "DB_DATABASE=". env('DB_DATABASE');
        $newValue = "DB_DATABASE=$database";

        $this->content = S($this->content)->replace($currentValue, $newValue);
        config(['database.connections.mysql.database'=> $database]);

        return $this;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setDbUsername( $username = 'root' )
    {
        $currentValue = "DB_USERNAME=". env('DB_USERNAME');
        $newValue = "DB_USERNAME=$username";

        $this->content = S($this->content)->replace($currentValue, $newValue);
        config(['database.connections.mysql.username'=> $username]);

        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setDbPassword( $password = 'root' )
    {
        $currentValue = "DB_PASSWORD=". env('DB_PASSWORD');
        $newValue = "DB_PASSWORD=$password";

        $this->content = S($this->content)->replace($currentValue, $newValue);
        config(['database.connections.mysql.password'=> $password]);

        return $this;
    }

    /**
     * save the modified content to the file.
     */
    public function save()
    {
        file_put_contents($this->pathToFile, $this->content);
    }

    /**
     * DotEnvEditor constructor.
     * @param $pathToFile
     */
    public function __construct( $pathToFile )
    {
        $this->pathToFile = $pathToFile;
        $this->content = file_get_contents($pathToFile);
    }
}