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

//        Helper::binDebug($arrStands);

        require APP . 'view/events/stand/index.php';
    }

    function list()
    {
        $arrStandsParams["stand_id"] = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
        $arrStands = $this->standMedia->getAll($arrStandsParams);
        /* Valid Extensions */
        $valid_extensions = array("jpg", "jpeg", "png");


        require APP . 'view/events/stand/media/index.php';
    }

    function upload()
    {
        require APP . 'view/events/stand/media/upload.php';
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
        $arrMediaParams ["name"] = basename($_REQUEST["input_stand_name"]);
        $arrMediaParams ["description"] = $target;
        $imageFileType = pathinfo($target, PATHINFO_EXTENSION);

        /* Valid Extensions */
        $valid_extensions = array("jpg", "jpeg", "png");
        /* Check file extension */
        if (!in_array(strtolower($imageFileType), $valid_extensions)) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo 0;
        } else {

            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                $media_id = $this->media->persist($arrMediaParams);

                if ((int)$media_id > 0) {

                    $arrEventStand["event_id"] = $_REQUEST["input_stand_event"];
                    $arrEventStand["image_id"] = $media_id;

                    $user_id = $this->model->persist($arrEventStand);

                    if ((int)$user_id > 0) {
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

            $directory = DIRECTORY_STANDS_MEDIA;


            $uploadOk = 1;
            $imageFileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

            /* Valid Extensions */
            $valid_extensions_img = array("jpg", "jpeg", "png");
            $valid_extensions_video = array("mp4");

            /* Check file extension */
            if (!in_array(strtolower($imageFileType), $valid_extensions_img))
                $uploadOk = 0;


            if ($uploadOk = 0 and !in_array(strtolower($imageFileType), $valid_extensions_video))
                $uploadOk = 0;

            $directory .= ($uploadOk = 1 and in_array(strtolower($imageFileType), $valid_extensions_img)) ? "image/" : "video/";

            $target = $directory . $_FILES["file"]["name"];
            $arrMediaParams ["name"] = basename($_FILES["file"]["name"]);
            $arrMediaParams ["description"] = $target;

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