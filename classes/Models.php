<?php

include_once 'DB.php';
include_once 'Brands.php';
include_once 'Prices.php';

class Models extends DB
{

    protected $tblname = 'models';

    private $id;

    private $brand;

    private $brand_id;

    private $model;

    private $year_of_edition;

    private $price;

    private $price_id;

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
     * @return Brands
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
        $this->brand->insert(array('brand' => $brand));
        $this->brand->setBrand($brand);
    }

    /**
     * @return int
     */
    public function getBrandId()
    {
        return $this->brand->getIdBy('brand', $this->brand->getBrand());
    }

    /**
     * @param int $brand_id
     */
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * @return string
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
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function getYearOfEdition()
    {
        return $this->year_of_edition;
    }

    /**
     * @param int $year_of_edition
     */
    public function setYearOfEdition($year_of_edition)
    {
        $this->year_of_edition = $year_of_edition;
    }

    /**
     * @return Prices
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price->insert(array('price' => $price));
        $this->price->setPrice($price);
    }

    /**
     * @return int
     */
    public function getPriceId()
    {
        return $this->price->getIdBy('price', $this->price->getPrice());
    }

    /**
     * @param int $price_id
     */
    public function setPriceId($price_id)
    {
        $this->price_id = $price_id;
    }

    public function __construct()
    {
        parent::__construct();
        $this->brand = new Brands();
        $this->price = new Prices();
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