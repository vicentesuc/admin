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

    function getAll($params = array())
    {
        return $this->database->select(
            "users",
            [
                "[><]franchises" => ["users.franchise_id" => "id"],
                "[><]roles" => ["users.role_id" => "id"],
                "[><]media" => ["users.image_id" => "id"],
                "[><]countries" => ["users.country_id" => "id"]
            ],
            [
                "users.id",
                "users.name",
                "users.email",
                "users.franchise_id",
                "franchises.es_name",
                "franchises.en_name",
                "users.role_id",
                "roles.name(role_desc)",
                "users.pass",
                "users.activation_key",
                "users.status",
                "users.image_id",
                "media.name(media_name)",
                "media.description",
                "users.country_id",
                "countries.name(country_desc)",
                "users.date"
            ],
            [
                "AND" => [
                    "users.role_id" => isset($params["role_id"]) ? $params["role_id"] : Medoo::raw("users.role_id"),
                    "users.country_id" => isset($params["country_id"]) ? $params["country_id"] : Medoo::raw("users.country_id"),
                    "users.franchise_id" => isset($params["franchise_id"]) ? $params["franchise_id"] : Medoo::raw("users.franchise_id"),
                ]
            ]
        );
    }

    function getByEmail($paramas = array())
    {
        return $this->database->get("users",
            [
                "id",
                "name",
                "pass"
            ],
            [
                "email" => $paramas["email"]
            ]
        );
    }

    function getByEmailAndPass($params = array())
    {
        return $this->database->get("users",
            [
                "id",
                "name",
                "pass"
            ],
            [
                "email" => $params["email"],
                "pass" => Medoo::raw("md5('" . $params["pwd"] . "')"),
            ]
        );
    }

    function getById($id = 0)
    {
        return $this->database->get(
            "users",
            [
                "users.id",
                "users.name",
                "users.email",
                "users.franchise_id",
                "users.role_id",
                "users.pass",
                "users.activation_key",
                "users.status",
                "users.image_id",
                "users.country_id",
                "users.date",
            ],
            [
                "users.id" => $id
            ]
        );
    }

    function persist($params = array())
    {
        $this->database->insert(
            "users",
            $params
        );

        return $this->database->id();
    }

    function update($params = array())
    {
        $data = $this->database->update(
            "users",
            $params,
            [
                "id" => $params["id"]
            ]
        );

        return $data->rowCount();
    }

}