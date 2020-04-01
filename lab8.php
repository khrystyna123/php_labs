<link rel="stylesheet" href="styles/formsStyle.css">
<div class="container">
    <form method="post">
        <div class="col-25">
            <label>Choose date </label>
        </div>
        <div class="col-75">
            <input type="date" name="date" />
        </div>

        <div class="col-25">
            <label>Add N days </label>
        </div>
        <div class="col-75">
            <input type="number" name="n_days" />
        </div>

        <div>
            <label><input type="submit" name="submit" /></label>
        </div>
    </form>
</div>

<?php

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $days = $_POST['n_days'];

    echo '<p align="center">' . date('d/m/y', strtotime($date. ' + ' . $days . ' days')) . '</p>';
}

require_once 'forms/script.php';
