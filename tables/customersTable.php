<?php

function printInfo($result) {

    echo '<link rel="stylesheet" href="../styles/tableStyle.css">
<table id="monitors" align="center">
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
    </tr>';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["firstname"]. "</td><td>" . $row["lastname"]. "</td></tr>";
    }

    $result->free();

    echo '</table>';
}