<?php
require APP . 'repository/DaoRoles.php';
require APP . 'repository/DaoCountries.php';
require APP . 'repository/DaoFranchise.php';
require APP . 'repository/DaoMedia.php';

class User extends controller
{
    private $countries;
    private $roles;
    private $franchise;
    private $media;

    function __construct()
    {
        parent::__construct();
        $this->inject('DaoUser');
        $this->countries = new DaoCountries($this->db);
        $this->roles = new DaoRoles($this->db);
        $this->franchise = new DaoFranchise($this->db);
        $this->media = new DaoMedia($this->db);
    }

    public function index()
    {

        $arraParams = array();

        if (isset($_REQUEST["country"]))
            $arraParams["country_id"] = $_REQUEST["country"];

        if (isset($_REQUEST["role"]))
            $arraParams["role_id"] = $_REQUEST["role"];


        $arraUsers = $this->model->getAll($arraParams);
        $arrRoles = $this->roles->getAll();
        $arrCountries = $this->countries->getAll();


        require APP . 'view/_templates/header.php';
        require APP . 'view/user/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function create()
    {
        $arrRoles = $this->roles->getAll();
        $arrCountries = $this->countries->getAll();
        $arrFranchises = $this->franchise->getAll();

        require APP . 'view/user/create.php';

    }

    public function edit()
    {
        $arrRoles = $this->roles->getAll();
        $arrCountries = $this->countries->getAll();
        $arrFranchises = $this->franchise->getAll();

        $arrUser = array();
        if (isset($_REQUEST["id"]))
            $arrUser = $this->model->getById($_REQUEST["id"]);

        $arrMedia = array();
        if (count($arrUser) > 0)
            $arrMedia = $this->media->getById($arrUser["image_id"]);


//        Helper::binDebug($arrMedia);

        require APP . 'view/user/edit.php';

    }

    function createPost()
    {

        if (isset($_FILES) and isset($_FILES["file"])) {

            $directory = DIRECTORY_USER_MEDIA;
            $target = $directory . "/" . $_FILES["file"]["name"];

            $uploadOk = 1;
            $arrMediaParams["name"] = basename($_FILES["file"]["name"]);
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
                print_r(Helper::setMessage("Usuario No Actualizado (B)", "FAIL", "error"));

            } else {

                $arrMediaParams["id"] = $this->media->persist($arrMediaParams);

                if ((int)$arrMediaParams["id"] > 0) {

                    $arrUserParams["name"] = $_REQUEST["input_user_name"];
                    $arrUserParams["email"] = $_REQUEST["input_user_email"];
                    $arrUserParams["franchise_id"] = $_REQUEST["sel_user_franchise"];
                    $arrUserParams["role_id"] = $_REQUEST["sel_user_role"];
                    $arrUserParams["pass"] = Medoo::raw("md5('" . $_REQUEST["input_user_pwd"] . "')");
                    $arrUserParams["activation_key"] = '%';
                    $arrUserParams["status"] = 1;
                    $arrUserParams["image_id"] = $arrMediaParams["id"];
                    $arrUserParams["country_id"] = $_REQUEST["sel_user_country"];
                    $arrUserParams["date"] = NOW;

                    $user_id = $this->model->persist($arrUserParams);

                    $target = $directory . $user_id . "/" . $_FILES["file"]["name"];
                    $directoryp = $directory . $user_id . "/";

                    if (!file_exists($directoryp)) {
                        mkdir($directoryp, 0777, true);
                    }

                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

                        $arrMediaParams["url"] = $target;
                        $media = $this->media->update($arrMediaParams);

                        if ((int)$media > 0) {
                            print_r(Helper::setMessage("Usuario Creado", "OK", "success"));
                        } else {
                            print_r(Helper::setMessage("Usuario No Creado", "FAIL", "error"));
                        }

                    } else {

                        $this->media->delete($arrMediaParams["id"]);
                        $this->model->delete($user_id);

                        print_r(Helper::setMessage("Imagen No Creada", "FAIL", "error"));
                    }
                }
            }
        }
    }

    function editPost()
    {

        $media_id = 0;
        $arrMediaParams["id"] = 0;
        $uploadOk = 1;
        if (isset($_FILES) and isset($_FILES["file"])) {

            $directory = DIRECTORY_USER_MEDIA;
            $target = $directory . $_FILES["file"]["name"];

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

        }


        if ($uploadOk == 0) {

            $this->media->delete($arrMediaParams["id"]);
            print_r(Helper::setMessage("Usuario No Actualizado (A)", "FAIL", "error"));

        } else {

            if (isset($_REQUEST["input_user_id"])) {

                $arrUserParams["id"] = $_REQUEST["input_user_id"];
                $arrUserParams["name"] = $_REQUEST["input_user_name"];
                $arrUserParams["email"] = $_REQUEST["input_user_email"];
                $arrUserParams["franchise_id"] = $_REQUEST["sel_user_franchise"];
                $arrUserParams["role_id"] = $_REQUEST["sel_user_role"];

                if ($_REQUEST["input_user_pwd"] != "*****")
                    $arrUserParams["pass"] = Medoo::raw("md5('" . $_REQUEST["input_user_pwd"] . "')");

                $arrUserParams["activation_key"] = '%';
                $arrUserParams["status"] = isset($_REQUEST["chk_user_status"]) ? 1 : 0;

                if ((int)$arrMediaParams["id"] > 0)
                    $arrUserParams["image_id"] = $arrMediaParams["id"];

                $arrUserParams["country_id"] = $_REQUEST["sel_user_country"];
                $arrUserParams["date"] = NOW;

                $row_upd = $this->model->update($arrUserParams);


                if ($arrMediaParams["id"] > 0) {

                    $target = $directory . $arrUserParams["id"] . "/" . $_FILES["file"]["name"];
                    $directoryp = $directory . $arrUserParams["id"] . "/";

                    if (!file_exists($directoryp)) {
                        mkdir($directoryp, 0777, true);
                    }

                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                        $arrMediaParams["url"] = $target;
                        $media = $this->media->update($arrMediaParams);

                        if ((int)$media > 0) {
                            print_r(Helper::setMessage("Usuario Actualizado", "OK", "success"));
                        } else {
                            print_r(Helper::setMessage("Usuario No Actualizado", "FAIL", "error"));
                        }
                    }
                } else {
                    print_r(Helper::setMessage("Usuario Actualizado", "OK", "success"));
                }
            }
        }
    }
}
