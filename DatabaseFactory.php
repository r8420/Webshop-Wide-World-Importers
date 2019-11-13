<?php


class DatabaseFactory
{

    private $host = "wwiproject.ml";
    private $databasename = "***REMOVED***_wwi";
    private $user = "***REMOVED***_wwi";
    private $password = "1Ik0iDKy2JNo";
    private $port = 3306;

    public function getConnection()
    {
        try {
            $connection = mysqli_connect($this->host, $this->databasename, $this->user, $this->password, $this->port);
            return $connection;
        } catch (mysqli_sql_exception $exception){
            print $exception;
            return "Error";
        }

    }

}

?>