<?php

class DaoUser
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

    function getAll($params =array()){

     return   $this->database->select("users",
         ["[><]"]
     );

    }

}