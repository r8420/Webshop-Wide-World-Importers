<?php
/**
 * Deze functie initialed de database connectie via een object
 * @return false|mysqli|string
 */

function startDBConnection(){
    $connectionObject = new DatabaseFactory();
    $connection = $connectionObject->getConnection();
    return $connection;
}

/**
 * Class DatabaseFactory
 * Object met dataBaseconnectie
 */
class DatabaseFactory
{

    private $host = "wwiproject.ml";
    private $databasename = "***REMOVED***_wwi";
    private $user = "***REMOVED***_wwi";
    private $dbpassword = "1Ik0iDKy2JNo";
    private $port = 3306;

    /**
     * start de connectie
     * indien het mis gaat is er een error handeling
     * @return false|mysqli|string
     */
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
