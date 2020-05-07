<?php

function printInfo($result) {

    echo '<link rel="stylesheet" href="../styles/tableStyle.css">
<table id="monitors" align="center">
    <tr>
        <th>Brand</th>
    </tr>';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["brand"]. "</td></tr>";
    }

    $result->free();

    echo '</table>';
}