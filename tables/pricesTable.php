<?php

function printInfo($result) {

    echo '<link rel="stylesheet" href="../styles/tableStyle.css">
<table id="monitors" align="center">
    <tr>
        <th>Price</th>
    </tr>';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["price"]. "</td></tr>";
    }

    $result->free();

    echo '</table>';
}