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
        header("location:" . URL . "login");
    }

    function validate()
    {
        if (isset($_REQUEST["input_pwd"]) and isset($_REQUEST["input_email"])) {

            $arrParams["email"] = $_REQUEST["input_email"];
            $arrParams["pwd"] = $_REQUEST["input_pwd"];

            $arrUser = $this->model->getByEmail($arrParams);

            Helper::binDebug($arrUser);

            if (count($arrUser) > 0) {

                if ($arrUser["pass"] == $_REQUEST["input_pwd"]) {

                    $_SESSION["name"] =$arrUser["name"];

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
