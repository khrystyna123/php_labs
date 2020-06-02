<?php  include('../users/config.php'); ?>

<?php
    global $conn;
    $verse = $conn->query("SELECT * FROM pages WHERE page='home' AND id < 7");
    $text = $conn->query("SELECT * FROM pages WHERE page='home' AND id = 7");
?>

<?php require_once('../includes/header.php') ?>
    <div class="container">
    <?php include('../includes/navbar.php') ?>

    <div class="content">
        <h2 class="content-title">Михайло Грушевський</h2>
        <hr>
        <div>
            <img src="../static/images/index.jpeg" style="float: left">
            <?php while ($row = $verse->fetch_assoc()) {
                echo "<p style=\"text-align: right\">" . $row["text"]. "</p><br>";
            } ?>
            <br>
            <?php
                $row = $text->fetch_assoc();
                echo "<p><b>Миха́йло Сергі́йович Груше́вський </b>" . $row["text"]. "</p><br>";
            ?>
        </div>

    </div>

<?php include('../includes/footer.php') ?>

