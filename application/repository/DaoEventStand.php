<?php


class DaoEventStand
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
            "event_stands",
            [
                "[><]events" => ["event_stands.event_id" => "id"],
                "[><]media" => ["event_stands.image_id" => "id"]
            ],
            [
                "event_stands.id(stand_id)",
                "event_stands.event_id",
                "media.description(media_url)",
                "media.name(media_name)",
            ],
            [
                "AND" => [
                    "event_id" => $params["event_id"]
                ]
            ]);

    }

    function getById($params = array())
    {
        return $this->database->get(
            "event_stands",
            [
                "event_id",
                "speaker_id",
                "profile_id"
            ],
            [
                "AND" => [
                    "event_id" => $params["event_id"],
                    "speaker_id" => $params["speaker_id"],
                    "profile_id" => $params["profile_id"]
                ]
            ]);

    }


    function persist($params = array())
    {
        $this->database->insert(
            "event_stands",
            $params
        );

        return $this->database->id();
    }


    function delete($params = array())
    {
        $data = $this->database->delete(
            "event_stands", [
            "AND" => [
                "event_id" => $params["event_id"],
                "profile_id" => $params["profile_id"]
            ]
        ]);
        return $data->rowCount();
    }

}