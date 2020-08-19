<?php

class DaoEvents
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
            "events",
            [
                "[><]franchises" => ["events.franchise_id" => "id"],
                "[><]media" => ["events.image_id" => "id"]
            ],
            [
                "events.id",
                "events.title",
                "events.description",
                "events.franchise_id",
                "franchises.es_name",
                "franchises.en_name",
                "events.image_id",
                "event_date"=>Medoo::raw("date_format(events.event_date,'%Y-%m-%d %H:%i')"),
                "events.video_id",
                "events.survey_url",
                "events.language",
                "events.date",
            ]
        );
    }

    function getById($id = 0)
    {
        return $this->database->get(
            "events",
            [
                "[><]franchises" => ["events.franchise_id" => "id"],
                "[><]media" => ["events.image_id" => "id"]
            ],
            [
                "events.id",
                "events.title",
                "events.description",
                "events.franchise_id",
                "events.image_id",
                "event_date"=>Medoo::raw("date_format(events.event_date,'%Y-%m-%d %H:%i')"),
                "events.video_id",
                "events.survey_url",
                "events.language",
                "events.date",
                "media.description(media_url)",
            ],
            [
                "events.id" => $id
            ]
        );
    }

    function persist($params = array())
    {
        $this->database->insert(
            "events",
            $params
        );

        return $this->database->id();
    }

    function update($params = array())
    {
        $data = $this->database->update(
            "events",
            $params,
            [
                "id" => $params["id"]
            ]
        );

        return $data->rowCount();
    }

}