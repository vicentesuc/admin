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

        require APP . 'view/user/edit.php';

    }

    function createPost()
    {

        if (isset($_FILES) and isset($_FILES["file"])) {

            $directory = DIRECTORY_USER_MEDIA;
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

                        $arrUserParams["name"] = $_REQUEST["input_user_name"];
                        $arrUserParams["email"] = $_REQUEST["input_user_email"];
                        $arrUserParams["franchise_id"] = $_REQUEST["sel_user_franchise"];
                        $arrUserParams["role_id"] = $_REQUEST["sel_user_role"];
                        $arrUserParams["pass"] = $_REQUEST["input_user_pwd"];
                        $arrUserParams["activation_key"] = '%';
                        $arrUserParams["status"] = 1;
                        $arrUserParams["image_id"] = $media_id;
                        $arrUserParams["country_id"] = $_REQUEST["sel_user_country"];
                        $arrUserParams["date"] = NOW;

                        $user_id = $this->model->persist($arrUserParams);

                        if ((int)$user_id > 0) {
                            print_r(Helper::setMessage("Usuario Creado", "OK", "success"));
                        } else {
                            print_r(Helper::setMessage("Usuario No Creado", "FAIL", "error"));
                        }
                    }

                } else {
                    echo 0;
                }

            }
        }

    }

    function editPost()
    {

        $media_id = 0;

        if (isset($_FILES) and isset($_FILES["file"])) {

            $directory = DIRECTORY_USER_MEDIA;
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

//            Helper::binDebug($target);

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

        if (isset($_REQUEST["input_user_id"])) {

            $arrUserParams["id"] = $_REQUEST["input_user_id"];
            $arrUserParams["name"] = $_REQUEST["input_user_name"];
            $arrUserParams["email"] = $_REQUEST["input_user_email"];
            $arrUserParams["franchise_id"] = $_REQUEST["sel_user_franchise"];
            $arrUserParams["role_id"] = $_REQUEST["sel_user_role"];

            if ($_REQUEST["input_user_pwd"] != "*****")
                $arrUserParams["pass"] = $_REQUEST["input_user_pwd"];

            $arrUserParams["activation_key"] = '%';
            $arrUserParams["status"] = isset($_REQUEST["chk_user_status"]) ? 1 : 0;

            if ((int)$media_id > 0)
                $arrUserParams["image_id"] = $media_id;

            $arrUserParams["country_id"] = $_REQUEST["sel_user_country"];
            $arrUserParams["date"] = NOW;

            $row_upd = $this->model->update($arrUserParams);

            if ((int)$row_upd > 0) {
                print_r(Helper::setMessage("Usuario Actualizado", "OK", "success"));
            } else {
                print_r(Helper::setMessage("Usuario No Actualizado", "FAIL", "error"));
            }

        }
    }
}
