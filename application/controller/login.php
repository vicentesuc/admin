<?php

class Login extends controller
{

    function __construct()
    {
        parent::__construct();
        $this->inject('DaoUser');
    }

    function index()
    {
        require APP . 'view/login/index.php';
    }

    function logout()
    {
        session_destroy();

        header("location:" . URL . "login");
    }

    function validate()
    {
        if (isset($_REQUEST["input_pwd"]) and isset($_REQUEST["input_email"])) {

            $arrParams["email"] = $_REQUEST["input_email"];
            $arrParams["pwd"] = $_REQUEST["input_pwd"];

            $arrUserEmail = $this->model->getByEmail($arrParams);

            if (count($arrUserEmail) > 0) {

                $arrUserPass = $this->model->getByEmailAndPass($arrParams);


                if (count($arrUserPass) > 0) {

                    $_SESSION["name"] = $arrUserPass["name"];

                    header("location:" . URL . "events/calendar");

                } else {
                    header("location:" . URL . "login?pwd=fail");
                }
            } else {
                header("location:" . URL . "login?msg=fail");
            }

        } else {
            header("location:" . URL . "login?msg=fail");
        }
    }
}
