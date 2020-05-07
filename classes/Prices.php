<?php

include_once 'DB.php';

class Prices extends DB
{

    protected $tblname = 'prices';

    private $id;

    private $price;

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
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param double $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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