<?php
class User extends controller
{
    public function index()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/user/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function create()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/user/create.php';
        require APP . 'view/_templates/footer.php';
    }
}
