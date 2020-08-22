<?php

class DaoMedia
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
        return $this->database->get("media",
            [
                "id",
                "name",
                "description"
            ],
            [
                "id" => $id
            ]
        );
    }

    function persist($params = array())
    {
        $this->database->insert("media",
            [
                "name" => $params["name"],
                "description" => $params["description"]
            ]
        );

        return $this->database->id();
    }

    function update($params = array())
    {
        $data = $this->database->update("media",
            [
                "name" => $params["name"],
                "description" => $params["description"]
            ],
            [
                "id" => $params["id"]
            ]
        );

        return $data->rowCount();
    }

    function delete($id = 0)
    {
        $data = $this->database->delete("media", [
            "AND" => [
                "id" => $id
            ]
        ]);

        echo $data->rowCount();

    }
}