<?php
require APP . 'repository/DaoCountries.php';
require APP . 'repository/DaoMedia.php';
require APP . 'repository/DaoFranchise.php';
require APP . 'repository/DaoEventMedia.php';

class Events extends controller
{
    private $countries;
    private $media;
    private $franchise;
    private $eventMedia;

    function __construct()
    {
        parent::__construct();
        $this->inject('DaoEvents');
        $this->countries = new DaoCountries($this->db);
        $this->media = new DaoMedia($this->db);
        $this->franchise = new DaoFranchise($this->db);
        $this->eventMedia = new DaoEventMedia($this->db);
    }

    function index()
    {
        $arrEvents = $this->model->getAll();
        $arrLanguages = $this->countries->getLanguage();
        $arrFranchise = $this->franchise->getAll();

        require APP . 'view/_templates/header.php';
        require APP . 'view/events/index.php';
        require APP . 'view/_templates/footer.php';
    }

    function create()
    {
        $arrFranchise = $this->franchise->getAll();
        $arrLanguages = $this->countries->getLanguage();
        require APP . 'view/events/create.php';
    }

    function edit()
    {
        $arrFranchise = $this->franchise->getAll();
        $arrLanguages = $this->countries->getLanguage();

        $arrEvent = array();
        if (isset($_REQUEST["id"]))
            $arrEvent = $this->model->getById($_REQUEST["id"]);


        require APP . 'view/_templates/header.php';
        require APP . 'view/events/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    function createPost()
    {

        $directory = "media/";
        $target = $directory . $_FILES["file"]["name"];

        $uploadOk = 1;
        $arrMediaParams ["name"] = basename($_FILES["file"]["name"]);
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


                    $arrEventParams["title"] = $_REQUEST["input_event_title"];
                    $arrEventParams["description"] = $_REQUEST["input_event_description"];
                    $arrEventParams["franchise_id"] = $_REQUEST["input_event_franchise"];
                    $arrEventParams["image_id"] = $media_id;
                    $arrEventParams["event_date"] = $_REQUEST["input_event_date"];
                    $arrEventParams["video_id"] = $media_id;
                    $arrEventParams["survey_url"] = $_REQUEST["input_event_survey"];
                    $arrEventParams["language"] = $_REQUEST["input_event_language"];
                    $arrEventParams["date"] = NOW;

                    $event_id = $this->model->persist($arrEventParams);

                    if ((int)$event_id > 0) {
                        print_r(Helper::setMessage("Evento Creado", "OK", "success"));
                    } else {
                        print_r(Helper::setMessage("Evento No Creado", "FAIL", "error"));
                    }

                }
            } else {
                echo 0;
            }
        }
    }

    function editPost()
    {
        $media_id = 0;

        if (isset($_FILES) and isset($_FILES["file"])) {

            $directory = "media/";
            $target = $directory . $_FILES["file"]["name"];

            $uploadOk = 1;
            $arrMediaParams ["name"] = basename($_FILES["file"]["name"]);
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
                }
            }
        }

        if (isset($_REQUEST["input_event_id"])) {

            $arrEventParams["id"] = $_REQUEST["input_event_id"];
            $arrEventParams["title"] = $_REQUEST["input_event_title"];
            $arrEventParams["description"] = $_REQUEST["input_event_description"];
            $arrEventParams["franchise_id"] = $_REQUEST["input_event_franchise"];
            $arrEventParams["event_date"] = $_REQUEST["input_event_date"];
            $arrEventParams["survey_url"] = $_REQUEST["input_event_survey"];
            $arrEventParams["language"] = $_REQUEST["input_event_language"];
            $arrEventParams["date"] = NOW;

            if ((int)$media_id > 0) {
                $arrEventParams["image_id"] = $media_id;
                $arrEventParams["video_id"] = $media_id;
            }

            $row_upd = $this->model->update($arrEventParams);
            if ((int)$row_upd > 0) {
                print_r(Helper::setMessage("Evento Actualizado", "OK", "success"));
            } else {
                print_r(Helper::setMessage("Evento No Actualizado", "FAIL", "error"));
            }
        }
    }

    function postMedia()
    {

        $media_id = 0;

        if (isset($_FILES) and isset($_FILES["file"]) and (isset($_REQUEST["media_event_id"]))) {

            $directory = "media/" . $_REQUEST["media_event_id"] . "/";

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
                        $eventMediaParams["event_id"] = $_REQUEST["media_event_id"];
                        $eventMediaParams["media_id"] = $media_id;
                        $this->eventMedia->persist($eventMediaParams);
                    }
                }
            }
        }
    }
}
