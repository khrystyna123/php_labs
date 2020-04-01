<?php

function createTableHeader()
{
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
}

function createTableData($monitors) {
    echo '<tr>';
    foreach ($monitors as $monitor) {
        echo '<td>' . $monitor . '</td>';
    }
    echo '</tr>';
}
