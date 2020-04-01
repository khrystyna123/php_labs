<?php

if ($file = fopen('/home/khrystyna/monitors.csv', 'a+')) {
    require_once 'forms/formAdd.php';

    if (isset($_POST['submit'])) {
        $array = array($_POST['brand'], $_POST['model'], $_POST['year_of_edition'], $_POST['price'],
            $_POST['date_of_sale'], $_POST['name_of_customer']);

        fputcsv($file, $array);

        require_once 'forms/script.php';
    }

    fclose($file);

    $file = fopen('/home/khrystyna/monitors.csv', 'r');

    include_once 'tables/tableFromArray.php';
    createTableHeader();
    while (!feof($file)) {
        $monitors = fgetcsv($file);
        createTableData($monitors);
    }
    echo '</table>';

    fclose($file);
} else {
    exit("Error opening file");
}