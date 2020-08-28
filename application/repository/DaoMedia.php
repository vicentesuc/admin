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


    function getById($id = 0)
    {
        return $this->database->get(
            "media",
            [
                "id",
                "name",
                "description",
                "url"
            ],
            [
                "id" => $id
            ]
        );
    }

    function persist($params = array())
    {
        $this->database->insert(
            "media",
            $params
        );

        return $this->database->id();
    }

    function update($params = array())
    {

        $data = $this->database->update(
            "media",
            $params,
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

        return $data->rowCount();
    }
}