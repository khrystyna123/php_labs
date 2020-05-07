<?php

function printInfo($result) {

    echo '<link rel="stylesheet" href="../styles/tableStyle.css">
<table id="monitors" align="center">
    <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>Edition year</th>
        <th>Price</th>
    </tr>';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row['brand_id']. "</td><td>" . $row['model'].
            "</td><td>" . $row['year_of_edition']. "</td><td>" . $row['price_id']. "</td></tr>";
    }

    $result->free();

    echo '</table>';
}