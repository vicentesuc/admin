<?php
class Login extends controller
{

    function __construct(){
        parent::__construct();
        $this->inject('DaoLogin');
    }

    public function index()
    {
        require APP . 'view/login/index.php';
    }

    public function logout()
    {
        header("location:".URL."login" );
    }
}
