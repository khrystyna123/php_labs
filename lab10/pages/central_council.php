<?php  include('../users/config.php'); ?>

<?php
global $conn;
$text17 = $conn->query("SELECT * FROM pages WHERE page='council' AND year='1917'");
$text18 = $conn->query("SELECT * FROM pages WHERE page='council' AND year='1918'");
$text19 = $conn->query("SELECT * FROM pages WHERE page='council' AND year='1919'");
?>

<?php require_once('../includes/header.php') ?>
    <div class="container">
    <?php include('../includes/navbar.php') ?>

    <div class="content">
        <hr>
        <img src="../static/images/index2.jpeg" style="display: block; margin: auto">
        <br>
        <div style="text-align: left">
            <p><b>1917 рік</b></p>
            <?php while ($row = $text17->fetch_assoc()) {
                echo "<p>" . $row["text"]. "</p>";
            } ?>
            <br>
            <p><b>1918 рік</b></p>
            <?php while ($row = $text18->fetch_assoc()) {
                echo "<p>" . $row["text"]. "</p>";
            } ?>
            <br>
            <p><b>1919 рік</b></p>
            <?php while ($row = $text19->fetch_assoc()) {
                echo "<p>" . $row["text"]. "</p>";
            } ?>
        </div>
    </div>

<?php include('../includes/footer.php') ?>