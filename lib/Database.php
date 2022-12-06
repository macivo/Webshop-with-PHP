<?php
include 'dbData/config.php';

/**
 * Database connection
 * only for Models
 */
class Database extends mysqli{
    static private $connection;

    static public function connection() {
        @self::$connection = new Database(HOST, USERNAME, PASSWORD, DATABASE);
        return self::$connection->connect_errno == 0;
    }

    static public function getInstance() {
        return self::$connection;
    }

    static public function doQuery($sqlQuery) {
        $connecteted = self::getInstance();
        if (!isset($connecteted)){
            self::connection();
        }
        return self::getInstance()->query($sqlQuery);
    }

    public function __construct($host, $username, $password, $database) {
        parent::__construct($host, $username, $password, $database);
    }
}