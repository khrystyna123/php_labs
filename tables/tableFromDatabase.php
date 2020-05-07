<?php

function printInfo($result) {

echo '<link rel="stylesheet" href="../styles/tableStyle.css">
<table id="monitors" align="center">
    <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>Edition year</th>
        <th>Price</th>
        <th>Sale date</th>
        <th>Customer</th>
    </tr>';

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["brand"]. "</td><td>" . $row["model"].
        "</td><td>" . $row["year_of_edition"]. "</td><td>" . $row["price"]. "</td><td>"
        . $row["date_of_sale"]. "</td><td>" . $row["name_of_customer"]. "</td></tr>";
}

$result->free();

echo '</table>';
}