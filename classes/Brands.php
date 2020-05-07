<?php

include_once 'DB.php';

class Brands extends DB
{

    protected $tblname = 'brands';

    private $id;

    private $brand;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        parent::insert($data);
    }

    public function findBy($key, $value)
    {
        return parent::findBy($key, $value);
    }

    public function getIdBy($key, $value)
    {
        return parent::getIdBy($key, $value);
    }

    public function getAll()
    {
        return parent::getAll();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}