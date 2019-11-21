<?php

class DatabaseFactory
{

    private $host = "wwiproject.ml";
    private $databasename = "u6221p23137_wwi";
    private $user = "u6221p23137_wwi";
    private $dbpassword = "1Ik0iDKy2JNo";
    private $port = 3306;

    public function getConnection()
    {
        try {
            $connection = mysqli_connect($this->host, $this->user, $this->dbpassword, $this->databasename, $this->port);
            return $connection;
        } catch (mysqli_sql_exception $exception) {
            print $exception;
            return "Error";
        }
    }
}

?>