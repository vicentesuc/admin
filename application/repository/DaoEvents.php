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

    function getAll($arraParams = array())
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
                "event_date" => Medoo::raw("date_format(events.event_date,'%Y-%m-%d %H:%i')"),
                "events.video_id",
                "events.survey_url",
                "events.event_link",
                "events.hashtag",
                "events.language",
                "events.date",
                "event_year" => Medoo::raw("date_format(events.event_date,'%Y')"),
                "event_month" => Medoo::raw("date_format(events.event_date,'%m')"),
                "event_day" => Medoo::raw("date_format(events.event_date,'%d')"),
                "event_hour" => Medoo::raw("date_format(events.event_date,'%h')"),
                "event_minute" => Medoo::raw("date_format(events.event_date,'%i')"),
            ],
            [
                "AND" => [
                    "franchises.id" => (isset($arraParams["franchise"])) ? $arraParams["franchise"] : Medoo::raw("franchises.id"),
                    "events.language" => (isset($arraParams["language"])) ? $arraParams["language"] : Medoo::raw("events.language")
                ],
                "ORDER" => ["events.id" => "DESC"]
            ]
        );
    }

    function getById($id = 0)
    {
        return $this->database->get(
            "events",
            [
                "[><]franchises" => ["events.franchise_id" => "id"],
                "[><]media" => ["events.image_id" => "id"],
                "[>]media(media_diploma)" => ["events.diploma_image_id" => "id"]
            ],
            [
                "events.id",
                "events.title",
                "events.description",
                "events.franchise_id",
                "events.hashtag",
                "events.image_id",
                "event_date" => Medoo::raw("date_format(events.event_date,'%Y-%m-%d %H:%i')"),
                "events.video_id",
                "events.survey_url",
                "events.event_link",
                "events.language",
                "events.date",
                "media.url(media_url)",
                "media_diploma.url(media_url_diploma)",

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