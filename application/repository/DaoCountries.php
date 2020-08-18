<?php

class DaoCountries
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

    function getLanguage()
    {
        return $this->database->select("countries",
            "language",
            [
                "GROUP" => ["language"]
            ]
        );
    }

    function getAll()
    {
        return $this->database->select("countries",
            [
                "id",
                "name",
                "language"
            ]
        );
    }

    function getById($id = 0)
    {
        return $this->database->select("countries",
            [
                "id",
                "name",
                "language"
            ],
            [
                "id" => $id
            ]
        );
    }

    function persist($params = array())
    {
        $this->database->insert("countries",
            [
                "name" => $params["name"],
                "language" => $params["language"]
            ]
        );

        return $this->database->id();
    }

    function update($params = array())
    {
        $data = $this->database->update("countries",
            [
                "name" => $params["name"],
                "language" => $params["language"]
            ],
            [
                "id" => $params["id"]
            ]
        );

        return $data->rowCount();
    }
}