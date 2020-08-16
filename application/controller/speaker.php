<?php

class Speaker extends controller
{
    public function index()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/speaker/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
