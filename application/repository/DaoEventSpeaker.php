<?php


class DaoEventSpeaker
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
        $data = $this->database->select(
            "event_speakers",
            [
                "event_id",
                "speaker_id",
                "profile_id"
            ],
            [
                "AND" => [
                    "event_id" => $params["event_id"],
                    "profile_id" => $params["profile_id"],
                ]
            ]);

        $arrayReturn = array();
        foreach ($data as $key => $value) {
            $arrayReturn[$value["speaker_id"]]["speaker_id"] = $value["speaker_id"];
            $arrayReturn[$value["speaker_id"]]["event_id"] = $value["event_id"];
            $arrayReturn[$value["speaker_id"]]["profile_id"] = $value["profile_id"];
        }

        return $arrayReturn;

    }

    function getAllEvents($id = array())
    {
        $data = $this->database->select(
            "event_speakers",
            [
                "event_id",
                "speaker_id",
                "profile_id"
            ],
            [
                "AND" => [
                    "event_id" => $id
                ]
            ]);

        $arrayReturn = array();
        foreach ($data as $key => $value) {
            $arrayReturn[$value["speaker_id"]]["speaker_id"] = $value["speaker_id"];
            $arrayReturn[$value["speaker_id"]]["event_id"] = $value["event_id"];
            $arrayReturn[$value["speaker_id"]]["profile_id"] = $value["profile_id"];
        }

        return $arrayReturn;

    }

    function getById($params = array())
    {
        return $this->database->get(
            "event_speakers",
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
            "event_speakers",
            $params
        );

        return $this->database->id();
    }


    function delete($params = array())
    {
        $data = $this->database->delete(
            "event_speakers", [
            "AND" => [
                "event_id" => $params["event_id"],
                "profile_id" => $params["profile_id"]
            ]
        ]);
        return $data->rowCount();
    }


}