<?php

require APP . 'repository/DaoMedia.php';

class Media extends controller
{

    private $media;


    function __construct()
    {
        parent::__construct();
        $this->inject('DaoEventMedia');
        $this->media = new DaoMedia($this->db);
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
}