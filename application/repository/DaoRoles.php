<?php

class DaoRoles
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
        return $this->database->select(
            "roles",
            [
                "id",
                "name"
            ]
        );
    }

    function getById($id = 0)
    {
        $this->database->get(
            "roles",
            [
                "id",
                "name"
            ],
            [
                "id" => $id
            ]
        );
    }
}