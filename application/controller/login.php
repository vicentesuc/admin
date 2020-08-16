<?php
class Login extends controller
{

    function __construct(){
        parent::__construct();
        $this->inject('DaoLogin');
    }

    public function index()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/login/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
