<?php
require APP . 'repository/DaoEvents.php';
require APP . 'repository/DaoMedia.php';
require APP . 'repository/DaoStandMedia.php';

class Stand extends controller
{
    private $events;
    private $media;
    private $standMedia;

    function __construct()
    {
        parent::__construct();
        $this->inject('DaoEventStand');
        $this->events = new DaoEvents($this->db);
        $this->media = new DaoMedia($this->db);
        $this->standMedia = new DaoStandMedia($this->db);
    }

    function index()
    {
        $arrStandsParams["event_id"] = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
        $arrStands = $this->model->getAll($arrStandsParams);

        /* Valid Extensions */
        $valid_extensions = array("jpg", "jpeg", "png");

        require APP . 'view/events/stand/index.php';
    }

    function tabs(){

        require APP . 'view/events/stand/stand_tabs.php';
    }

    function images()
    {
        $valid_extensions = array("jpg", "jpeg", "png");

        $arrStandsParams["stand_id"] = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
        $arrStandsMedia = $this->standMedia->getAll($arrStandsParams);


        require APP . 'view/events/stand/image/index.php';
    }

    function video()
    {
        $valid_extensions = array("mp4", "avi");

        $arrStandsParams["stand_id"] = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
        $arrStandsMedia = $this->standMedia->getAll($arrStandsParams);

        require APP . 'view/events/stand/video/index.php';
    }

    function document()
    {
        $valid_extensions = array("pdf");

        $arrStandsParams["stand_id"] = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
        $arrStandsMedia = $this->standMedia->getAll($arrStandsParams);


        require APP . 'view/events/stand/document/index.php';
    }

    function upload()
    {
        require APP . 'view/events/stand/image/upload.php';
    }

    function create()
    {
        require APP . 'view/events/stand/create.php';
    }


    function createPost()
    {

        $directory = DIRECTORY_STANDS_MEDIA;
        $target = $directory . $_FILES["file"]["name"];

        $uploadOk = 1;
        $arrMediaParams["name"] = basename($_REQUEST["input_stand_name"]);
        $arrMediaParams["url"] = $target;
        $arrMediaParams["description"] = "%";
        $imageFileType = pathinfo($target, PATHINFO_EXTENSION);

        /* Valid Extensions */
        $valid_extensions = array("jpg", "jpeg", "png");
        /* Check file extension */
        if (!in_array(strtolower($imageFileType), $valid_extensions)) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            print_r(Helper::setMessage("Stand No creado (B)", "FAIL", "error"));
        } else {

            $arrMediaParams["id"] = $this->media->persist($arrMediaParams);

            if ((int)$arrMediaParams["id"] > 0) {

                $arrEventStand["event_id"] = $_REQUEST["input_stand_event"];
                $arrEventStand["image_id"] = $arrMediaParams["id"];

                $eventStandId = $this->model->persist($arrEventStand);

                $target = $directory . $eventStandId . "/" . $_FILES["file"]["name"];
                $directoryp = $directory . $eventStandId . "/";

                if (!file_exists($directoryp)) {
                    mkdir($directoryp, 0777, true);
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

                    $arrMediaParams["url"] = $target;
                    $media = $this->media->update($arrMediaParams);

                    if ((int)$media > 0) {
                        print_r(Helper::setMessage("Stand Creado", "OK", "success"));
                    } else {
                        print_r(Helper::setMessage("Stand No Creado", "FAIL", "error"));
                    }
                }

            } else {
                echo 0;
            }
        }
    }

    function postMedia()
    {

        $media_id = 0;

        if (isset($_FILES) and isset($_FILES["file"]) and (isset($_REQUEST["input_stand_id"]))) {

            $directory = DIRECTORY_STANDS_MEDIA . $_REQUEST["input_stand_id"] . "/";


            $uploadOk = 0;
            $imageFileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

            /* Valid Extensions */
            $valid_extensions_img = array("jpg", "jpeg", "png");
            $valid_extensions_video = array("mp4");
            $valid_extensions_pdf = array("pdf");



            /* Check file extension */
            if (in_array(strtolower($imageFileType), $valid_extensions_img)) {
                $uploadOk = 1;
                $directory .= DIRECTORY_STAND_MEDIA_IMG;
            }


            if ($uploadOk == 0 and in_array(strtolower($imageFileType), $valid_extensions_video)) {
                $uploadOk = 1;
                $directory .= DIRECTORY_STAND_MEDIA_VIDEO;
            }


            if ($uploadOk == 0 and in_array(strtolower($imageFileType), $valid_extensions_pdf)) {
                $uploadOk = 1;
                $directory .= DIRECTORY_STAND_MEDIA_DOCS;
            }

            $target = $directory . $_FILES["file"]["name"];
            $arrMediaParams["name"] = basename($_FILES["file"]["name"]);
            $arrMediaParams["url"] = $target;
            $arrMediaParams["description"] = "%";


            if ($uploadOk == 0) {
                echo 0;
            } else {

                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                    $media_id = $this->media->persist($arrMediaParams);

                    if ((int)$media_id > 0) {
                        $standMediaParams["stand_id"] = $_REQUEST["input_stand_id"];
                        $standMediaParams["media_id"] = $media_id;
                        $this->standMedia->persist($standMediaParams);
                    }
                }
            }
        }
    }
}