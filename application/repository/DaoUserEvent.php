<?php

class DaoUserEvent
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
        if ($this->database->has("account", $params))
            return 0;
        

        $this->database->insert(
            "user_events",
            $params
        );

        return $this->database->id();
    }

}