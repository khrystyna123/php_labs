<?php  include('../users/config.php'); ?>

<?php
global $conn;
$text = $conn->query("SELECT * FROM pages WHERE page='biography'");
?>

<?php require_once('../includes/header.php') ?>
    <div class="container">
    <?php include('../includes/navbar.php') ?>

    <div class="content">
        <hr>
        <img src="../static/images/mif_unr_0-696x398.jpg" style="display: block; margin: auto">
        <br>
        <div style="text-align: left">
            <?php while ($row = $text->fetch_assoc()) {
                echo "<p>" . $row["text"]. "</p>";
            } ?>
        </div>
    </div>

<?php include('../includes/footer.php') ?>