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

        require APP . 'view/_templates/header.php';
        require APP . 'view/franchise/index.php';
        require APP . 'view/_templates/footer.php';
    }

    function create()
    {
        require APP . 'view/franchise/create.php';
    }

    function edit()
    {
        $arrFranchise = array();
        if (isset($_REQUEST["id"]))
            $arrFranchise = $this->model->getById($_REQUEST["id"]);

//        Helper::binDebug($arrFranchise);

        require APP . 'view/franchise/edit.php';
    }

    function createPost()
    {
        $arrParams["es_name"] = $_REQUEST["input_franchise_es"];
        $arrParams["en_name"] = $_REQUEST["input_franchise_en"];

        $id = $this->model->persist($arrParams);

        if ((int)$id > 0) {
            print_r(Helper::setMessage("Creado Exitosamente", "OK", "success"));
        } else {
            print_r(Helper::setMessage("No se pudo crear", "FAIL", "error"));
        }
    }

    function editPost()
    {
        $arrParams["es_name"] = $_REQUEST["input_franchise_es"];
        $arrParams["en_name"] = $_REQUEST["input_franchise_en"];
        $arrParams["id"] = $_REQUEST["input_franchise_id"];

        $rowCount = $this->model->update($arrParams);
        if ((int)$rowCount > 0) {
            print_r(Helper::setMessage("Actualizado Exitosamente", "OK", "success"));
        } else {
            print_r(Helper::setMessage("No se pudo actualizar", "FAIL", "error"));
        }
    }
}
