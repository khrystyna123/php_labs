<?php

include_once 'DB.php';

class Customers extends DB
{

    protected $tblname = 'customers';

    private $id;

    private $firstname;

    private $lastname;

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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
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

    public function lastId()
    {
        return parent::lastId();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}