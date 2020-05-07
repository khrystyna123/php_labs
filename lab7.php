<?php

include_once 'classes/Brands.php';
include_once 'classes/Customers.php';
include_once 'classes/Models.php';
include_once 'classes/Prices.php';
include_once 'classes/Sales.php';

require_once 'forms/addToTables.php';

if (isset($_POST['submit'])) {
    if (!empty($_POST['brand'])) {
        $brand = new Brands();
        $data = array('brand' => $_POST['brand']);
        $brand->insert($data);
        $result = $brand->getAll();
        require_once 'tables/brandsTable.php';
        printInfo($result);
    }
    if (!empty($_POST['price'])) {
        $price = new Prices();
        $data = array('price' => $_POST['price']);
        $price->insert($data);
        $result = $price->getAll();
        require_once 'tables/pricesTable.php';
        printInfo($result);
    }
    if (!empty($_POST['model'])) {
        $model = new Models();
        $model->setBrand($_POST['brand_model']);
        $model->setPrice($_POST['price_model']);
        $data = array('brand_id' => $model->getBrandId(), 'model' => $_POST['model'],
            'year_of_edition' => $_POST['year_of_edition'], 'price_id' => $model->getPriceId());
        $model->insert($data);
        $result = $model->getAll();
        require_once 'tables/modelsTable.php';
        printInfo($result);
    }
    if (!empty($_POST['model_sale'])) {
        $sale = new Sales();
        $sale->setModel($_POST['model_sale']);
        $sale->setCustomer($_POST['firstname_sale'], $_POST['lastname_sale']);
        $data = array('model_id' => $sale->getModelId() , 'customer_id' => $sale->getCustomerId(),
            'date_of_sale' => $_POST['date_of_sale']);
        $sale->insert($data);
        $result = $sale->getAll();
        require_once 'tables/salesTable.php';
        printInfo($result);
    }
    if (!empty($_POST['firstname'])) {
        $customer = new Customers();
        $data = array('firstname' => $_POST['firstname'], 'lastname' => $_POST['lastname']);
        $customer->insert($data);
        $result = $customer->getAll();
        require_once 'tables/customersTable.php';
        printInfo($result);
    }
}

$monitor = new Models;

require_once 'forms/formFind.php';

if (isset($_GET['submit1'])) {
    $result = $monitor->findBy('brand_id', $_GET['string']);
    require_once 'tables/modelsTable.php';
    printInfo($result);
    $monitor->__destruct();
}

require_once 'forms/script.php';
