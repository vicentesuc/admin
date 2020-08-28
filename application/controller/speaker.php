<?php

require APP . 'repository/DaoMedia.php';

class Speaker extends controller
{
    private $media;

    function __construct()
    {
        parent::__construct();
        $this->inject('DaoSpeaker');
        $this->media = new DaoMedia($this->db);
    }


    public function index()
    {
        $arrSpekers = $this->model->getAll();

        require APP . 'view/_templates/header.php';
        require APP . 'view/speaker/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function create()
    {
        require APP . 'view/speaker/create.php';
    }

    public function createPost()
    {
        $directory = DIRECTORY_SPEAKER_MEDIA;
        $target = $directory . $_FILES["file"]["name"];

        $uploadOk = 1;
        $arrMediaParams ["name"] = basename($_FILES["file"]["name"]);
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
            print_r(Helper::setMessage("Usuario No Creado (B)", "FAIL", "error"));
        } else {

            $arrMediaParams["id"] = $this->media->persist($arrMediaParams);

            if ((int)$arrMediaParams["id"] > 0) {

                $arrSpeakerParams["name"] = $_REQUEST["input_speaker_name"];
                $arrSpeakerParams["es_specialty"] = $_REQUEST["input_speaker_es_specialty"];
                $arrSpeakerParams["en_specialty"] = $_REQUEST["input_speaker_en_specialty"];
                $arrSpeakerParams["image_id"] = $arrMediaParams["id"];

                $speaker_id = $this->model->persist($arrSpeakerParams);

                $target = $directory . $speaker_id . "/" . $_FILES["file"]["name"];
                $directoryp = $directory . $speaker_id . "/";

                if (!file_exists($directoryp)) {
                    mkdir($directoryp, 0777, true);
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

                    $arrMediaParams["url"] = $target;
                    $media = $this->media->update($arrMediaParams);

                    if ((int)$speaker_id > 0) {
                        print_r(Helper::setMessage("Speaker Creado", "OK", "success"));
                    } else {
                        print_r(Helper::setMessage("Speaker No Creado", "FAIL", "error"));
                    }
                } else {
                    $this->media->delete($arrMediaParams["id"]);
                    $this->model->delete($speaker_id);
                    print_r(Helper::setMessage("Imagen No Creada", "FAIL", "error"));
                }
            }
        }
    }


    public function edit()
    {
        $arrSpeaker = array();
        if (isset($_REQUEST["id"]))
            $arrSpeaker = $this->model->getById($_REQUEST["id"]);

        $arrMedia = array();
        if (count($arrSpeaker) > 0)
            $arrMedia = $this->media->getById($arrSpeaker["image_id"]);

        require APP . 'view/speaker/edit.php';

    }

    function editPost()
    {

        $media_id = 0;

        if (isset($_FILES) and isset($_FILES["file"])) {

            $directory = DIRECTORY_SPEAKER_MEDIA;
            $target = $directory . $_FILES["file"]["name"];

            $uploadOk = 1;
            $arrMediaParams ["name"] = basename($_FILES["file"]["name"]);
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
                $this->media->delete($arrMediaParams["id"]);
                print_r(Helper::setMessage("Speaker no Agregado (B)", "FAIL", "error"));
            } else {

                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                    $media_id = $this->media->persist($arrMediaParams);
                }
            }
        }

        if (isset($_REQUEST["input_speaker_id"])) {

            $arrSpeakerParams["id"] = $_REQUEST["input_speaker_id"];
            $arrSpeakerParams["es_specialty"] = $_REQUEST["input_speaker_es_specialty"];
            $arrSpeakerParams["en_specialty"] = $_REQUEST["input_speaker_en_specialty"];

            if ((int)$media_id > 0)
                $arrSpeakerParams["image_id"] = $media_id;


            $row_upd = $this->model->update($arrSpeakerParams);

            if ((int)$row_upd > 0) {
                print_r(Helper::setMessage("Speaker Actualizado", "OK", "success"));
            } else {
                print_r(Helper::setMessage("Speaker No Actualizado", "FAIL", "error"));
            }
        }
    }

}
