<?php
/**
 * Deze functie initialed de database connectie via een object
 * @return false|mysqli|string
 */

function startDBConnection() {
    $connectionObject = new DatabaseFactory();
    return $connectionObject->getConnection();
}

/**
 * Class DatabaseFactory
 * Object met database connectie
 */
class DatabaseFactory {

    private $host = 'wwiproject.ml';
    private $databaseName = '_wwi';
    private $user = '_application';
    private $databasePassword = '';
    private $port = 3306;

    /**
     * start de connectie
     * indien het mis gaat is er een error handeling
     * @return false|mysqli|string
     */
    public function getConnection() {
        try {
            return mysqli_connect($this->host, $this->user, $this->databasePassword, $this->databaseName, $this->port);
        } catch (mysqli_sql_exception $exception) {
            print $exception;
            return 'Error';
        }
    }
}

