<?php

function printInfo($result) {

    echo '<link rel="stylesheet" href="../styles/tableStyle.css">
<table id="monitors" align="center">
    <tr>
        <th>Model</th>
        <th>Customer</th>
        <th>Date of sale</th>
    </tr>';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["model_id"]. "</td><td>" . $row["customer_id"].
            "</td><td>" . $row["date_of_sale"] . "</td></tr>";
    }

    $result->free();

    echo '</table>';
}