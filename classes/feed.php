<?php

class Feed {

    public $dbconnection;
    public $id;
    public $url;


    public function __construct($db)
    {
        $this->dbconnection = $db;
    }


    function add() {

        if ($this->validate()) {
            $sql = 'INSERT INTO feed (url)
                    VALUES ("' . $this->url . '")';
            $statement = $this->dbconnection->prepare($sql);

            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }

    }


    function validate() {

        if (simplexml_load_string(@file_get_contents($this->url))) {
            return true;
        }
        else {
            return false;
        }
    }


    public function totalRows() {

        $sql = 'SELECT id FROM feed';
        $statement = $this->dbconnection->prepare($sql);
        $statement->execute();
        $total = $statement->rowCount();

        return $total;
    }


    function update() {

        $sql = 'UPDATE feed
                SET url = "'. $this->url .'"
                WHERE id = ' . $this->id;
        $statement = $this->dbconnection->prepare($sql);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function delete() {

        $sql = 'DELETE FROM feed
                WHERE id = ' . $_GET['id'];
        $statement = $this->dbconnection->prepare($sql);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function getAllFeeds() {

        $sql = 'SELECT id, url
                FROM feed
                ORDER BY id';
        $statement = $this->dbconnection->prepare($sql);
        $statement->execute();

        return $statement;
    }


    function getFeed() {
        $sql = 'SELECT url
                FROM feed
                WHERE id = ' . $this->id;

        $statement = $this->dbconnection->prepare($sql);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $this->url = $row['url'];
        }
        else {
            die('ID not found!');
        }

    }
}
