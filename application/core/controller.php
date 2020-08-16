<?php

class controller
{
    public $db = null;

    public $model = null;

    function __construct($model=null){
        $this->openDatabaseConnection();
    }

    private function openDatabaseConnection(){
        $this->db = new Medoo([
            'database_type' => DB_TYPE,
            'database_name' => DB_NAME,
            'server' => DB_HOST,
            'username' => DB_USER,
            'password' => DB_PASS,
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'port' => 3306,
            'command' => [
                'SET SQL_MODE=ANSI_QUOTES'
            ]
        ]);
    }

    public function inject($nombre){
        require APP . 'repository/'.$nombre.'.php';
        $this->model = new $nombre($this->db);
    }

}
