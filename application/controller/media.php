<?php

class Media extends controller
{

    function __construct()
    {
        parent::__construct();
        $this->inject('DaoEventMedia');
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

        require APP . 'view/media/document/index.php';
    }

    function delete()
    {
        $rowCount = 0;
        if ($_REQUEST["id"])
            $rowCount = $this->model->delete($_REQUEST["id"]);

        if ((int)$rowCount > 0) {
            print_r(Helper::setMessage("Eliminado Exitosamente", "OK", "success"));
        } else {
            print_r(Helper::setMessage("No se pudo Eliminar", "FAIL", "error"));
        }
    }
}