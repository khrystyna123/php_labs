<?php

include_once 'mysql/select.php';
require_once 'mysql/connectMysql.php';
require_once 'forms/add.php';

if (isset($_POST['submit'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year_of_edition =  $_POST['year_of_edition'];
    $price = $_POST['price'];
    $date_of_sale = $_POST['date_of_sale'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $query = "INSERT IGNORE INTO brands(brand) 
                VALUE('$brand');
              SET @id_brand = (SELECT id FROM brands WHERE brand = '$brand');
              INSERT IGNORE INTO prices(price)
                VALUE('$price');
              SET @id_price = (SELECT id FROM prices WHERE price = '$price');
              INSERT INTO customers(firstname, lastname)
                VALUES('$firstname', '$lastname');
              SET @id_customer = LAST_INSERT_ID(); 
              INSERT INTO models(brand_id, model, year_of_edition, price_id)
                VALUES(@id_brand, '$model', '$year_of_edition', @id_price);
              SET @id_model = LAST_INSERT_ID();
              INSERT INTO sales(model_id, customer_id, date_of_sale)
                VALUES(@id_model, @id_customer, '$date_of_sale')";
    $mysqli->multi_query($query);
}

if ($result = $mysqli->query($select. " ORDER BY p.price ASC")) {
    include_once 'tables/tableFromNormDb.php';
    printInfo($result);
}

echo '<br />';

if ($result = $mysqli->query("SELECT brand, count(m.brand_id) as number FROM brands b, models m, sales s
                                    WHERE b.id = m.brand_id and m.id = s.model_id GROUP BY b.brand")) {
    echo '<link rel="stylesheet" href="styles/tableStyle.css">
        <table id="monitors" align="center">
            <tr>
                <th>Brand</th>
                <th>Count</th>
            </tr>';
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["brand"]. "</td><td>" . $row["number"]. "</td></tr>";
    }
    echo '</table>';

    $result->free();
}

require_once 'forms/formFind.php';

if (isset($_GET['submit1'])) {
    if ($result = $mysqli->query($select . " AND (c.firstname like '%".$_GET['string']."%' 
                                            OR c.lastname like '%".$_GET['string']."%') ")) {
        include_once 'tables/tableFromNormDb.php';
        printInfo($result);
    }
}

mysqli_close($mysqli);

require_once 'forms/script.php';