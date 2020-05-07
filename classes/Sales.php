<?php

include_once 'DB.php';
include_once 'Customers.php';
include_once 'Models.php';

class Sales extends DB
{
    protected $tblname = 'sales';

    private $id;

    private $model;

    private $model_id;

    private $customer;

    private $customer_id;

    private $date_of_sale;

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
     * @return Models
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model->setModel($model);
    }

    /**
     * @return int
     */
    public function getModelId()
    {
        return $this->model->getIdBy('model', $this->model->getModel());
    }

    /**
     * @param int $model_id
     */
    public function setModelId($model_id)
    {
        $this->model_id = $model_id;
    }

    /**
     * @return Customers
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param string $firstname
     * @param string $lastname
     */
    public function setCustomer($firstname, $lastname)
    {
        $this->customer->insert(array('firstname' => $firstname, 'lastname' => $lastname));
        $this->customer->setFirstname($firstname);
        $this->customer->setLastname($lastname);
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        $id = $this->customer->getIdBy('firstname', $this->customer->getFirstname());
        while ($id) {
            if ($id == $this->customer->getIdBy('lastname', $this->customer->getLastname()))
                return $id;
        }
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return DateTime
     */
    public function getDateOfSale()
    {
        return $this->date_of_sale;
    }

    /**
     * @param DateTime $date_of_sale
     */
    public function setDateOfSale($date_of_sale)
    {
        $this->date_of_sale = $date_of_sale;
    }

    public function __construct()
    {
        parent::__construct();
        $this->model = new Models();
        $this->customer = new Customers();
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