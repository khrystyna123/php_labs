<?php

if ($file = fopen('/home/khrystyna/monitors.csv', 'r')) {
    $monitors = array_map('str_getcsv', file('/home/khrystyna/monitors.csv'));

    $price = array();
    foreach ($monitors as $key => $row) {
        $price[$key] = $row[3];
    }
    array_multisort($price, SORT_ASC, $monitors);

    include_once 'tables/tableFromArray.php';
    createTableHeader();
    foreach ($monitors as $monitor) {
        createTableData($monitor);
    }
    echo '</table>';

    echo '<br />';

    $brands = array_count_values(array_column($monitors, 0));

    echo '<link rel="stylesheet" href="styles/tableStyle.css">';
    echo '<table id="monitors" align="center">';
    echo '<tr>
            <th>Brand</th>
            <th>Count</th>
          </tr>';
    foreach ($brands as $brand => $value) {
        echo '<tr><td>' . $brand . '</td><td>' . $value . '</td></tr>';
    }
    echo '</table>';

    fclose($file);
} else {
    exit("Error opening file");
}