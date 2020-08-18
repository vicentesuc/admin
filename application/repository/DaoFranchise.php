<?php

class DaoFranchise
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

    function getAll()
    {

        return $this->database->select("franchises",
            [
                "id",
                "es_name",
                "en_name"
            ]
        );
    }

    function getById($id = 0)
    {
        return $this->database->get("franchises",
            [
                "id",
                "es_name",
                "en_name"
            ],
            [
                "id" => $id
            ]
        );
    }

    function persist($params = array())
    {
        $this->database->insert("franchises",
            [
                "es_name" => $params["es_name"],
                "en_name" => $params["en_name"]
            ]
        );

        return $this->database->id();
    }

    function update($params = array())
    {
        $data = $this->database->update("franchises",
            [
                "es_name" => $params["es_name"],
                "en_name" => $params["en_name"]
            ],
            [
                "id" => $params["id"]
            ]
        );

        return $data->rowCount();
    }
}