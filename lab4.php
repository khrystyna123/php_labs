<?php

require_once 'forms/formFind.php';
require_once 'forms/script.php';

if (isset($_GET['submit1'])) {
    if ($file = fopen('/home/khrystyna/monitors.csv', 'r')) {
        $monitors = array_map('str_getcsv', file('/home/khrystyna/monitors.csv'));


        include_once 'tables/tableFromArray.php';
        createTableHeader();
        foreach ($monitors as $monitor) {
            if (stripos($monitor[5], $_GET['string']) !== false) {
                createTableData($monitor);
            }
        }
        echo '</table>';

        fclose($file);
    } else {
        exit("Error opening file");
    }
}