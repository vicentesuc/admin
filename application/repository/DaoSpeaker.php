<?php

class DaoSpeaker
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
            "speakers",
            [
                "[><]media" => ["speakers.image_id" => "id"],
            ],
            [
                "speakers.id",
                "speakers.name",
                "speakers.es_specialty",
                "speakers.en_specialty",
                "speakers.image_id",
                "media.name(media_name)",
                "media.description(media_description)",
            ]
        );
    }

    function getById($id = 0)
    {
        return $this->database->get(
            "speakers",
            [
                "[><]media" => ["speakers.image_id" => "id"],
            ],
            [
                "speakers.id",
                "speakers.name",
                "speakers.es_specialty",
                "speakers.en_specialty",
                "speakers.image_id",
                "media.name(media_name)",
                "media.description(media_description)",
            ],
            [
                "speakers.id" => $id
            ]
        );
    }

    function persist($params = array())
    {
        $this->database->insert(
            "speakers",
            $params
        );

        return $this->database->id();
    }

    function update($params = array())
    {
        $data = $this->database->update(
            "speakers",
            $params,
            [
                "id" => $params["id"]
            ]
        );

        return $data->rowCount();
    }

}