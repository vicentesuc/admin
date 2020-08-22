<?php


class DaoEventMedia
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

    function getAll($id = 0)
    {
        return $this->database->select(
            "events",
            [
                "[><]event_media" => ["events.id" => "event_id"],
                "[><]media" => ["event_media.media_id" => "id"]
            ],
            [
                "events.id",
                "events.title",
                "events.description",
                "events.franchise_id",
                "media.description(media_url)",
                "media.name(media_name)",
                "media.id(media_id)",
                "events.image_id",
                "event_date" => Medoo::raw("date_format(events.event_date,'%Y-%m-%d %H:%i')"),
                "events.video_id",
                "events.survey_url",
                "events.language",
                "events.date",
            ],
            [
                "events.id" => $id
            ]
        );
    }


    function persist($params = array())
    {
        $this->database->insert(
            "event_media",
            $params
        );

        return $this->database->id();
    }

    function update($params = array())
    {
        $data = $this->database->update(
            "event_media",
            $params,
            [
                "id" => $params["id"]
            ]
        );

        return $data->rowCount();
    }

    function delete($params = array())
    {
        $data = $this->database->delete("event_media", [
            "AND" => [
                "event_id" => $params["event_id"],
                "media_id" => $params["media_id"]
            ]
        ]);
        return $data->rowCount();
    }

}