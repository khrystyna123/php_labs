<?php

require_once 'mysql/connectMysql.php';
require_once 'forms/formAdd.php';

if (isset($_POST['submit'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year_of_edition =  $_POST['year_of_edition'];
    $price = $_POST['price'];
    $date_of_sale = $_POST['date_of_sale'];
    $name_of_customer = $_POST['name_of_customer'];

    $query = "INSERT INTO info (brand, model, year_of_edition, price, date_of_sale, name_of_customer) 
                VALUES ('$brand', '$model', '$year_of_edition', '$price', '$date_of_sale', '$name_of_customer')";

    $mysqli->query($query);
}

if ($result = $mysqli->query("SELECT brand, model, year_of_edition, price, 
                                        date_of_sale, name_of_customer 
                                        FROM info ORDER BY price ASC")) {
    include_once 'tables/tableFromDatabase.php';
    printInfo($result);
}

echo '<br />';

if ($result = $mysqli->query("SELECT count(id) as number, brand FROM info GROUP BY brand")) {
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
    if ($result = $mysqli->query("SELECT brand, model, year_of_edition, price, 
                                            date_of_sale, name_of_customer 
                                            FROM info WHERE name_of_customer like '%".$_GET['string']."%'")) {
        include_once 'tables/tableFromDatabase.php';
        printInfo($result);
    }
}

mysqli_close($mysqli);

require_once 'forms/script.php';
