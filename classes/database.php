<?php

class Database {

    // database settings
    private $host = "localhost";
    private $dbname = "rssreader";
    private $username = "root";
    private $password = "";
    public  $connection;
    public  $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );  // error reporting


    // connecting to the database
    public function getConnection() {
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
        } catch (PDOException $error) {
            echo "Database Connection Error: " . $error->getMessage();
        }
        return $this->connection;
    }


    // for installing purposes only:
    // creating the database and tables with some data
    public function installing() {

        $this->connection = null;

        try {
            $connection = new PDO("mysql:host=" . $this->host, $this->username, $this->password, $this->options);
            $sql = file_get_contents("data/rssreader.sql");
            $connection->exec($sql);

            echo "Database and table feed created successfully, with some data.";
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
}
