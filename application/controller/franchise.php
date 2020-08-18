<?php

require APP . 'repository/DaoCountries.php';


class Franchise extends controller
{

    private $countries;

    function __construct()
    {
        parent::__construct();
        $this->inject('DaoFranchise');
        $this->countries = new DaoCountries($this->db);
    }

    function index()
    {
        $arrFranchise = $this->model->getAll();

        $arrLanguages = $this->countries->getLanguage();

//        Helper::binDebug($arrLanguages);

        require APP . 'view/_templates/header.php';
        require APP . 'view/franchise/index.php';
        require APP . 'view/_templates/footer.php';
    }

    function create()
    {
        require APP . 'view/franchise/create.php';
    }

}
