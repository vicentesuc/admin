<?php

class DaoStandMedia
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
            "stands_media",
            [
                "[><]media" => ["stands_media.media_id" => "id"]
            ],
            [                "stands_media.stand_id(stand_id)",
                "media.id(media_id)",
                "media.description(media_url)",
                "media.name(media_name)",
            ],
            [
                "AND" => [
                    "stands_media.stand_id" => $params["stand_id"]
                ]
            ]);
    }


    function persist($params = array())
    {
        $this->database->insert(
            "stands_media",
            $params
        );

        return $this->database->id();
    }


    function delete($params = array())
    {
        $data = $this->database->delete(
            "stands_media", [
            "AND" => [
                "stand_id" => $params["stand_id"],
                "media_id" => $params["media_id"]
            ]
        ]);
        return $data->rowCount();
    }

}