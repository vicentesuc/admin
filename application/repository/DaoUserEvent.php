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

    function update($params = array())
    {
        if (!$this->database->has(
            "user_events",
            [
                "event_id" => $params["event_id"],
                "user_id" => $params["user_id"]
            ]
        ))
            return 0;

        $data = $this->database->update(
            "user_events",
            [
                "diploma_id" => $params["diploma_id"]
            ],
            [
                "event_id" => $params["event_id"],
                "user_id" => $params["user_id"]
            ]
        );

        return 1;
    }

}