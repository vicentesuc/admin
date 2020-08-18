<?php

class  Franchise{

    private $id;
    private $es_name;
    private $en_name;

    /**
     * Franchise constructor.
     * @param $id
     * @param $es_name
     * @param $en_name
     */
    public function __construct($id, $es_name, $en_name)
    {
        $this->id = $id;
        $this->es_name = $es_name;
        $this->en_name = $en_name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEsName()
    {
        return $this->es_name;
    }

    /**
     * @param mixed $es_name
     */
    public function setEsName($es_name)
    {
        $this->es_name = $es_name;
    }

    /**
     * @return mixed
     */
    public function getEnName()
    {
        return $this->en_name;
    }

    /**
     * @param mixed $en_name
     */
    public function setEnName($en_name)
    {
        $this->en_name = $en_name;
    }

}
