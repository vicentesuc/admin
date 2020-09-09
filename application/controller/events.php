<?php
require APP . 'repository/DaoCountries.php';
require APP . 'repository/DaoMedia.php';
require APP . 'repository/DaoFranchise.php';
require APP . 'repository/DaoEventMedia.php';
require APP . 'repository/DaoSpeaker.php';
require APP . 'repository/DaoEventSpeaker.php';
require APP . 'repository/DaoEventStand.php';
require APP . 'repository/DaoStandMedia.php';
require APP . 'repository/DaoUser.php';
require APP . 'repository/DaoUserDiploma.php';

class Events extends controller
{
    private $countries;
    private $media;
    private $franchise;
    private $eventMedia;
    private $speaker;
    private $eventSpeaker;
    private $eventStand;
    private $standMedia;
    private $user;
    private $userDiploma;

    function __construct()
    {
        parent::__construct();
        $this->inject('DaoEvents');
        $this->countries = new DaoCountries($this->db);
        $this->media = new DaoMedia($this->db);
        $this->franchise = new DaoFranchise($this->db);
        $this->eventMedia = new DaoEventMedia($this->db);
        $this->speaker = new DaoSpeaker($this->db);
        $this->eventSpeaker = new DaoEventSpeaker($this->db);
        $this->eventStand = new DaoEventStand($this->db);
        $this->standMedia = new DaoStandMedia($this->db);
        $this->user = new DaoUser($this->db);
        $this->userDiploma = new DaoUserDiploma($this->db);
    }

    function index()
    {

        $arrParams = array();
        if (isset($_REQUEST["franchise"]))
            $arrParams["franchise"] = $_REQUEST["franchise"];

        if (isset($_REQUEST["language"]))
            $arrParams["language"] = $_REQUEST["language"];

        $arrEvents = $this->model->getAll($arrParams);
        $arrLanguages = $this->countries->getLanguage();
        $arrFranchise = $this->franchise->getAll();


//        Helper::binDebug($arrEvents);

        require APP . 'view/_templates/header.php';
        require APP . 'view/events/index.php';
        require APP . 'view/_templates/footer.php';
    }

    function speakers()
    {

        $arrModerator = array();
        $arrSpeakers = array();
        $arrExpositor = array();
        if ($_REQUEST["id"]) {

            $arraParams["event_id"] = $_REQUEST["id"];
            $arraParams["profile_id"] = MODERATOR;

            $arrModerator = $this->eventSpeaker->getAll($arraParams);

            $arraParams["profile_id"] = EXPOSITOR;
            $arrExpositor = $this->eventSpeaker->getAll($arraParams);

        }

//        Helper::binDebug($arrExpositor);

        $arrSpeakers = $this->speaker->getAll();
        require APP . 'view/events/speaker/index.php';
    }

    function postSpeaker()
    {
        $id = 0;
        if (isset($_REQUEST["speaker"]) and isset($_REQUEST["event"])) {

            $arrParams["profile_id"] = $_REQUEST["profile"];
            $arrParams["event_id"] = $_REQUEST["event"];
            $this->eventSpeaker->delete($arrParams);
            $row = 0;

            if (!empty($_REQUEST["speaker"])) {
                foreach ($_REQUEST["speaker"] as $key) {

                    $arrParams["speaker_id"] = $key;


                    if (empty($this->eventSpeaker->getById($arrParams))) {
                        $this->eventSpeaker->persist($arrParams);
                    }

                }
            }
        }
        print_r(Helper::setMessage("Actualizado", "OK", "success"));
    }


    function calendar()
    {

        $arrParams = array();
        if (isset($_REQUEST["franchise"]))
            $arrParams["franchise"] = $_REQUEST["franchise"];

        if (isset($_REQUEST["language"]))
            $arrParams["language"] = $_REQUEST["language"];

        $arrEvents = $this->model->getAll($arrParams);
        $arrLanguages = $this->countries->getLanguage();
        $arrFranchise = $this->franchise->getAll();

        $events = array();
        $count = 0;
        foreach ($arrEvents as $key => $value) {
            $events[$count]["title"] = $value["title"];
            $events[$count]["allDay"] = "false";
            $events[$count]["start"] = $value["event_date"];
            $events[$count]["className"] = "label-info";
            $events[$count]["event_id"] = $value["id"];

            $count++;
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/events/calendar/index.php';
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

//        Helper::binDebug($arrEvent);

        require APP . 'view/_templates/header.php';
        require APP . 'view/events/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    function createPost()
    {

        $directory = DIRECTORY_EVENTS_MEDIA;
        $target = $directory . $_FILES["file"]["name"];
        $targetd = $directory . $_FILES["filed"]["name"];
        $targetv = $directory . $_FILES["filev"]["name"];

        /*image prinicipal*/
        $uploadOk = 1;
        $arrMediaParams["name"] = basename($_FILES["file"]["name"]);
        $arrMediaParams["url"] = $target;
        $arrMediaParams["description"] = "%";
        $imageFileType = pathinfo($target, PATHINFO_EXTENSION);


        /* image diploma*/
        if (isset($_FILES["filed"])) {
            $uploadOk = 1;
            $arrMediaDiplomaParams["name"] = basename($_FILES["filed"]["name"]);
            $arrMediaDiplomaParams["url"] = $targetd;
            $arrMediaDiplomaParams["description"] = "%";
        }


        /* image diploma*/
        if (isset($_FILES["filev"])) {
            $uploadOk = 1;
            $arrMediaVideoParams["name"] = basename($_FILES["filev"]["name"]);
            $arrMediaVideoParams["url"] = $targetv;
            $arrMediaVideoParams["description"] = "%";
        }


        /* Valid Extensions */
        $valid_extensions = array("jpg", "jpeg", "png", "mp4", "avi");
        /* Check file extension */
        if (!in_array(strtolower($imageFileType), $valid_extensions)) {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            print_r(Helper::setMessage("Evento No creado (B)", "FAIL", "error"));
        } else {

            $arrMediaParams["id"] = $this->media->persist($arrMediaParams);

            $arrMediaDiplomaParams["id"] = 0;
            if (isset($_FILES["filed"])) {
                $arrMediaDiplomaParams["id"] = $this->media->persist($arrMediaDiplomaParams);
            }

            $arrMediaVideoParams["id"] = 0;
            if (isset($_FILES["filed"])) {
                $arrMediaVideoParams["id"] = $this->media->persist($arrMediaVideoParams);
            }


            if ($arrMediaParams["id"] > 0) {

                $arrEventParams["title"] = $_REQUEST["input_event_title"];
                $arrEventParams["description"] = $_REQUEST["input_event_description"];
                $arrEventParams["franchise_id"] = $_REQUEST["input_event_franchise"];
                $arrEventParams["image_id"] = $arrMediaParams["id"];
                $arrEventParams["diploma_image_id"] = $arrMediaDiplomaParams["id"];
                $arrEventParams["event_date"] = $_REQUEST["input_event_date"];
                $arrEventParams["video_id"] = $arrMediaVideoParams["id"];
                $arrEventParams["survey_url"] = $_REQUEST["input_event_survey"];
                $arrEventParams["event_link"] = $_REQUEST["input_event_link"];
                $arrEventParams["language"] = $_REQUEST["input_event_language"];
                $arrEventParams["hashtag"] = $_REQUEST["input_event_hashtag"];
                $arrEventParams["date"] = NOW;

                $event_id = $this->model->persist($arrEventParams);

                $target = $directory . $event_id . "/" . $_FILES["file"]["name"];
                $directoryp = $directory . $event_id . "/";

                $targetd = "";
                $directoryd = "";
                if (isset($_FILES["filed"])) {
                    $targetd = $directory . $event_id . "/" . DIRECTORY_EVENTS_MEDIA_DIPLOMA . $_FILES["filed"]["name"];
                    $directoryd = $directory . $event_id . "/" . DIRECTORY_EVENTS_MEDIA_DIPLOMA;

                }

                $targetv = "";
                $directoryv = "";
                if (isset($_FILES["filev"])) {
                    $targetv = $directory . $event_id . "/" . DIRECTORY_EVENTS_MEDIA_VIDEO . $_FILES["filev"]["name"];
                    $directoryv = $directory . $event_id . "/" . DIRECTORY_EVENTS_MEDIA_VIDEO;
                }

                /*move media*/
                if (!file_exists($directoryp)) {
                    mkdir($directoryp, 0777, true);
                }

                if (isset($_FILES["filed"])) {
                    if (!file_exists($directoryd)) {
                        mkdir($directoryd, 0777, true);
                    }
                }

                if (isset($_FILES["filev"])) {
                    if (!file_exists($directoryv)) {
                        mkdir($directoryv, 0777, true);
                    }
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

                    $arrMediaParams["url"] = $target;
                    $media = $this->media->update($arrMediaParams);

                    if (isset($_FILES["filed"])) {
                        move_uploaded_file($_FILES['filed']['tmp_name'], $targetd);
                        $arrMediaDiplomaParams["url"] = $targetd;
                        $mediaDiploma = $this->media->update($arrMediaDiplomaParams);
                    }

                    if (isset($_FILES["filev"])) {
                        move_uploaded_file($_FILES['filev']['tmp_name'], $targetv);
                        $arrMediaVideoParams["url"] = $targetv;
                        $mediavideo = $this->media->update($arrMediaVideoParams);
                    }

                    if ((int)$event_id > 0) {
                        print_r(Helper::setMessage("Evento Creado", "OK", "success"));
                    } else {
                        print_r(Helper::setMessage("Evento No Creado", "FAIL", "error"));
                    }

                } else {
                    $this->media->delete($arrMediaParams["id"]);
                    print_r(Helper::setMessage("Imagen No Creada", "FAIL", "error"));
                }

                /*move diploma*/


            }
        }
    }


    function editPost()
    {

        $media_id = 0;
        $arrMediaParams["id"] = 0;
        $uploadOk = 1;

        if (isset($_FILES) and isset($_FILES["file"])) {

            $directory = DIRECTORY_EVENTS_MEDIA . $_REQUEST["input_event_id"] . "/";

            $target = $directory . $_FILES["file"]["name"];

            /*image principal*/
            $arrMediaParams["name"] = basename($_FILES["file"]["name"]);
            $arrMediaParams["url"] = $target;
            $arrMediaParams["description"] = "%";

            $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
            $arrMediaParams["id"] = $this->media->persist($arrMediaParams);


            /* Valid Extensions */
            $valid_extensions = array("jpg", "jpeg", "png");
            /* Check file extension */
            if (!in_array(strtolower($imageFileType), $valid_extensions)) {
                $uploadOk = 0;
            }

            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            move_uploaded_file($_FILES['file']['tmp_name'], $target);

        }

        $arrMediaDiplomaParams["id"] = 0;
        if (isset($_FILES) and isset($_FILES["filed"])) {

            $directory = DIRECTORY_EVENTS_MEDIA . $_REQUEST["input_event_id"] . "/" . DIRECTORY_EVENTS_MEDIA_DIPLOMA;
            $targetd = $directory . $_FILES["filed"]["name"];

            $uploadOk = 1;
            $arrMediaDiplomaParams["name"] = basename($_FILES["filed"]["name"]);
            $arrMediaDiplomaParams["url"] = $targetd;
            $arrMediaDiplomaParams["description"] = "%";
            $arrMediaDiplomaParams["id"] = $this->media->persist($arrMediaDiplomaParams);

            $imageFileType = pathinfo($targetd, PATHINFO_EXTENSION);

            /* Valid Extensions */
            $valid_extensions = array("jpg", "jpeg", "png");
            /* Check file extension */
            if (!in_array(strtolower($imageFileType), $valid_extensions)) {
                $uploadOk = 0;
            }

            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            move_uploaded_file($_FILES['filed']['tmp_name'], $targetd);
        }

        $arrMediaVideoParams["id"] = 0;
        if (isset($_FILES) and isset($_FILES["filev"])) {

            $directoryv = DIRECTORY_EVENTS_MEDIA . $_REQUEST["input_event_id"] . "/" . DIRECTORY_EVENTS_MEDIA_VIDEO;
            $targetv = $directoryv . $_FILES["filev"]["name"];

            $uploadOk = 1;
            $arrMediaVideoParams["name"] = basename($_FILES["filev"]["name"]);
            $arrMediaVideoParams["url"] = $targetv;
            $arrMediaVideoParams["description"] = "%";
            $arrMediaVideoParams["id"] = $this->media->persist($arrMediaVideoParams);

            $videoFileType = pathinfo($targetv, PATHINFO_EXTENSION);

            /* Valid Extensions */
            $valid_extensions = array("mp4", "avi");
            /* Check file extension */
            if (!in_array(strtolower($videoFileType), $valid_extensions)) {
                $uploadOk = 0;
            }

            if (!file_exists($directoryv)) {
                mkdir($directoryv, 0777, true);
            }

            move_uploaded_file($_FILES['filev']['tmp_name'], $targetv);
        }


        if ($uploadOk == 0) {

            $this->media->delete($arrMediaParams["id"]);
            print_r(Helper::setMessage("Usuario No Actualizado (A)", "FAIL", "error"));

        } else {

            if (isset($_REQUEST["input_event_id"])) {

                $arrEventParams["id"] = $_REQUEST["input_event_id"];
                $arrEventParams["title"] = $_REQUEST["input_event_title"];
                $arrEventParams["description"] = $_REQUEST["input_event_description"];
                $arrEventParams["franchise_id"] = $_REQUEST["input_event_franchise"];
                $arrEventParams["event_date"] = $_REQUEST["input_event_date"];
                $arrEventParams["survey_url"] = $_REQUEST["input_event_survey"];
                $arrEventParams["event_link"] = $_REQUEST["input_event_link"];
                $arrEventParams["hashtag"] = $_REQUEST["input_event_hashtag"];
                $arrEventParams["language"] = $_REQUEST["input_event_language"];
                $arrEventParams["date"] = NOW;

                if ((int)$arrMediaParams["id"] > 0) {
                    $arrEventParams["image_id"] = $arrMediaParams["id"];

                }

                if ((int)$arrMediaVideoParams["id"] > 0) {
                    $arrEventParams["video_id"] = $arrMediaVideoParams["id"];
                }

                if ((int)$arrMediaDiplomaParams["id"] > 0) {
                    $arrEventParams["diploma_image_id"] = $arrMediaDiplomaParams["id"];
                }

                $row_upd = $this->model->update($arrEventParams);

                if ($row_upd > 0) {
                    print_r(Helper::setMessage("Usuario Actualizado", "OK", "success"));
                } else {
                    print_r(Helper::setMessage("Usuario No Actualizado", "FAIL", "error"));
                }
            }
        }
    }

    function postMedia()
    {

        $media_id = 0;

        if (isset($_FILES) and isset($_FILES["file"]) and (isset($_REQUEST["media_event_id"]))) {

            $directory = DIRECTORY_EVENTS_MEDIA . $_REQUEST["media_event_id"] . "/";


            $uploadOk = 0;
            $imageFileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

            /* Valid Extensions */
            $valid_extensions_img = array("jpg", "jpeg", "png");
            $valid_extensions_video = array("mp4");
            $valid_extensions_pdf = array("pdf");


            /* Check file extension */
            if (in_array(strtolower($imageFileType), $valid_extensions_img)) {
                $uploadOk = 1;
                $directory .= DIRECTORY_EVENTS_MEDIA_IMG;
            }


            if ($uploadOk == 0 and in_array(strtolower($imageFileType), $valid_extensions_video)) {
                $uploadOk = 1;
                $directory .= DIRECTORY_EVENTS_MEDIA_VIDEO;
            }


            if ($uploadOk == 0 and in_array(strtolower($imageFileType), $valid_extensions_pdf)) {
                $uploadOk = 1;
                $directory .= DIRECTORY_EVENTS_MEDIA_DOCS;
            }


            $target = $directory . $_FILES["file"]["name"];
            $arrMediaParams ["name"] = basename($_FILES["file"]["name"]);
            $arrMediaParams ["description"] = "%";
            $arrMediaParams ["url"] = $target;

            if ($uploadOk == 0) {
                echo "upload " . $uploadOk;
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

    function delete()
    {
        $arrEventMedia = $this->eventMedia->getAll($_REQUEST["event"]);

        /*delete event media*/
        foreach ($arrEventMedia as $key => $value) {

            if (file_exists($value["media_url"]))
                unlink($value["media_url"]);

            $rowCount = $this->media->delete($value["media_id"]);

            $arrEventMediaParams["event_id"] = $_REQUEST["event"];
            $arrEventMediaParams["media_id"] = $value["media_id"];
            $this->eventMedia->delete($arrEventMediaParams);
        }

        /*delete event speaker*/
        if (isset($_REQUEST["event"])) {

            $arrEventMediaParams["event_id"] = $_REQUEST["event"];
            $arrEventMediaParams["profile_id"] = 1;
            $this->eventSpeaker->delete($arrEventMediaParams);

            $arrEventMediaParams["event_id"] = $_REQUEST["event"];
            $arrEventMediaParams["profile_id"] = 2;
            $this->eventSpeaker->delete($arrEventMediaParams);
        }

        /*delete from stand and event */
        $arrEventStandParams["event_id"] = $_REQUEST["event"];
        $arrEventStand = $this->eventStand->getAll($arrEventStandParams);

        foreach ($arrEventStand as $key => $value) {

            $arrStandsParams["stand_id"] = $value["stand_id"];

            $arrStands = $this->standMedia->getAll($arrStandsParams);

            foreach ($arrStands as $key => $value) {
                $rowCount = 0;
                $id = $value["media_id"];
                $rowCount = $this->media->delete($id);

                if (file_exists($value["media_url"]))
                    unlink($value["media_url"]);

                $paramsDelete["stand_id"] = $value["stand_id"];
                $paramsDelete["media_id"] = $value["media_id"];
                $rowCount = $this->standMedia->delete($paramsDelete);
            }

            $paramsEventStand["event_id"] = $value["event_id"];
            $paramsEventStand["stand_id"] = $value["stand_id"];
            $rowCount = $this->eventStand->delete($paramsEventStand);
        }

        print_r(Helper::setMessage("Eliminado Exitosamente", "OK", "success"));
    }

    function diploma()
    {

        $arrEvents = $arrEvents = $this->model->getAll();
        require APP . 'view/_templates/header.php';
        require APP . 'view/events/diploma/index.php';
        require APP . 'view/_templates/footer.php';
    }

    function uploadDiploma()
    {
        header("Content-Type:  application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=" . $_FILES["file"]["name"] . "_R.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $directory = DIRECTORY_EVENTS_MEDIA . $_REQUEST["input_event_id"] . "/" . DIRECTORY_EVENTS_MEDIA_DIPLOMA;
        $arryExtension = array("csv", "xlsx");
        $target_file = $directory . basename($_FILES["file"]["name"]);
        $csvFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $arrEvent = $this->model->getById($_REQUEST["input_event_id"]);

        $directoryDiploma = DIRECTORY_EVENTS_MEDIA . $_REQUEST["input_event_id"] . "/" . DIRECTORY_EVENTS_MEDIA_USER_DIPLOMA;

        //revisamos la carpeta tenga permisos
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        /*mover el archivo csv*/
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        $columnas = array(array("columnaNombre" => "email"), array("columnaNombre" => "nota"));

        $headersFromFile = array_flip(fgetcsv(fopen($target_file, "r"), ","));

        $arrayHeader["code"] = "OK";
        $arrayHeader["msg"] = "Todo bien con los encabezados";
        foreach ($columnas as $key => $value) {
            if (!array_key_exists($value["columnaNombre"], $headersFromFile)) {
                $arrayHeader["code"] = "FAIL";
                $arrayHeader["msg"] = "Falta la columna " . $value["columnaNombre"];
            }
        }

        $arrayConsolidado = array();
        $arrReporte = array();
        if ($arrayHeader["code"] == "OK") {
            $row = 0;
            if (($handle = fopen($target_file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                    if ($row > 0) {
                        $arrUserParams["email"] = $data[0];
                        $arrReporte["email"] = $arrUserParams["email"];
                        if ($this->user->findByEmail($arrUserParams)) {
                            $arrUserParams = $this->user->getByEmail($arrUserParams);

                            $directoryDiploma .= "/" . $arrUserParams["id"];
                            $target_file_diploma = $directoryDiploma . "/" . str_replace(" ", "_", $arrEvent["title"]) . "_diploma.pdf";

                            //revisamos la carpeta tenga permisos
                            if (!file_exists($directoryDiploma)) {
                                mkdir($directoryDiploma, 0777, true);
                            }

                            $arrMediaParams["name"] = "diploma -" . $arrUserParams["name"];
                            $arrMediaParams["description"] = "%";
                            $arrMediaParams["url"] = $target_file_diploma;
                            $media_id = $this->media->persist($arrMediaParams);

                            $arrUserDiplomaParams["user_id"] = $arrUserParams["id"];
                            $arrUserDiplomaParams["media_id"] = $media_id;
                            $diploma = $this->userDiploma->persist($arrUserDiplomaParams);

                            if ($arrEvent["media_url_diploma"] != null || !empty($arrEvent["media_url_diploma"])) {

                                $pdf = new PDF();
                                $pdf->AddPage('L');
                                $pdf->addImage($arrEvent["media_url_diploma"]);

                                /*aqui puede ir el nombre*/
                                $pdf->addText($arrUserParams["name"], 0, 100);

                                /*aqui puede ir la nota*/
//                                $pdf->addText($data[1], 225, 135);

                                $pdf->Output('F', $target_file_diploma);

                                $arrReporte["msg"] = "success";
                            }
                        } else {
                            $arrReporte["msg"] = "Fail";
                        }

                        $arrayConsolidado[$row] = $arrReporte;
                    }


                    $row++;
                }
            }
            /*eliminar el csv*/
            unlink($target_file);

            require APP . 'view/report/auto.php';
        }
    }
}
