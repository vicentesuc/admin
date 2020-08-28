<?php

require APP . 'repository/DaoMedia.php';
require APP . 'repository/DaoStandMedia.php';
require APP . 'repository/DaoEventStand.php';

class Media extends controller
{

    private $media;
    private $standMedia;
    private $eventStand;

    function __construct()
    {
        parent::__construct();
        $this->inject('DaoEventMedia');
        $this->media = new DaoMedia($this->db);
        $this->standMedia = new DaoStandMedia($this->db);
        $this->eventStand = new DaoEventStand($this->db);

    }

    function images()
    {

        $valid_extensions = array("jpg", "jpeg", "png");

        $arrMediaImages = array();
        if (isset($_REQUEST["id"]))
            $arrMediaImages = $this->model->getAll($_REQUEST["id"]);

        require APP . 'view/media/image/index.php';
    }


    function video()
    {
        $valid_extensions = array("mp4", "avi");

        $arrMediaImages = array();
        if (isset($_REQUEST["id"]))
            $arrMediaImages = $this->model->getAll($_REQUEST["id"]);


        require APP . 'view/media/video/index.php';
    }

    function documents()
    {
        $valid_extensions = array("pdf");

        $arrMediaImages = array();
        if (isset($_REQUEST["id"]))
            $arrMediaImages = $this->model->getAll($_REQUEST["id"]);

//        Helper::binDebug($arrMediaImages);

        require APP . 'view/media/document/index.php';
    }

    function edit()
    {
        $arrMedia = $this->media->getById($_REQUEST["media"]);

        require APP . 'view/media/edit.php';
    }


    function editPost()
    {
        if (isset($_REQUEST["input_media_id"])) {

            $arrMediaParams["id"] = $_REQUEST["input_media_id"];
            $arrMediaParams["name"] = $_REQUEST["input_media_name"];
            $arrMediaParams["description"] = $_REQUEST["input_media_desc"];
            $rowCount = $this->media->update($arrMediaParams);

            print_r(Helper::setMessage("Actualizado Exitosamente", "OK", "success"));

        } else {
            print_r(Helper::setMessage("No se pudo Actualizar", "FAIL", "error"));
        }
    }

    function delete()
    {
        $rowCount = 0;
        if (isset($_REQUEST["media"])) {
            $id = $_REQUEST["media"];
            $rowCount = $this->media->delete($id);
        }

        if (isset($_REQUEST["event"]) and isset($_REQUEST["media"])) {

            $paramsDelete["event_id"] = $_REQUEST["event"];
            $paramsDelete["media_id"] = $_REQUEST["media"];
            $rowCount = $this->model->delete($paramsDelete);

        }

        if ((int)$rowCount > 0) {
            print_r(Helper::setMessage("Eliminado Exitosamente", "OK", "success"));
        } else {
            print_r(Helper::setMessage("No se pudo Eliminar", "FAIL", "error"));
        }
    }

    function stand_media_delete()
    {
        $rowCount = 0;
        if (isset($_REQUEST["media"])) {
            $id = $_REQUEST["media"];
            $rowCount = $this->media->delete($id);
        }

        if (isset($_REQUEST["stand"]) and isset($_REQUEST["media"])) {

            $paramsDelete["stand_id"] = $_REQUEST["stand"];
            $paramsDelete["media_id"] = $_REQUEST["media"];
            $rowCount = $this->standMedia->delete($paramsDelete);
        }

        if ((int)$rowCount > 0) {
            print_r(Helper::setMessage("Eliminado Exitosamente", "OK", "success"));
        } else {
            print_r(Helper::setMessage("No se pudo Eliminar", "FAIL", "error"));
        }
    }

    function stand_delete()
    {
        $arrStandsParams["stand_id"] = isset($_REQUEST["stand"]) ? $_REQUEST["stand"] : 0;
        $arrStands = $this->standMedia->getAll($arrStandsParams);

        foreach ($arrStands as $key => $value) {
            $rowCount = 0;
            $id = $value["media_id"];
            $rowCount = $this->media->delete($id);

            $paramsDelete["stand_id"] = $value["stand_id"];
            $paramsDelete["media_id"] = $value["media_id"];
            $rowCount = $this->standMedia->delete($paramsDelete);
        }

        $paramsEventStand["event_id"] = $_REQUEST["event"];
        $paramsEventStand["stand_id"] = $_REQUEST["stand"];
        $rowCount = $this->eventStand->delete($paramsEventStand);

        if ((int)$rowCount > 0) {
            print_r(Helper::setMessage("Eliminado Exitosamente", "OK", "success"));
        } else {
            print_r(Helper::setMessage("No se pudo Eliminar", "FAIL", "error"));
        }
    }

}