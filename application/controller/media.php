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
}