<?php

class DaoUserDiploma
{
    private $database;

    function __construct($db)
    {
        try {
            $this->database = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    function persist($params = array())
    {
        $this->database->insert(
            "user_diplomas",
            $params
        );

        return $this->database->id();
    }


}