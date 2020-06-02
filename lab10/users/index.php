<?php
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['msg'] = "Спочатку Ви маєте зареєструватися";
    header('location: registration/login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: registration/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Особистий кабінет</title>
    <link rel="stylesheet" type="text/css" href="../static/css/register_style.css">
</head>
<body>
    <div class="header">
        <h2>Особистий кабінет</h2>
    </div>
    <div class="content">

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success" >
                <h3>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <div class="profile_info">
            <div>
                <?php  if (isset($_SESSION['user'])) : ?>
                    <strong><?php echo $_SESSION['user']['username']; ?></strong>
                    <br>
                    <a href="account/create_post.php">Створити статтю</a>

                    <a href="account/posts.php">Мої статті</a>
                    <small>
                        <br>
                        <a href="registration/logout.php" class="logout-btn">Вихід</a>
                    </small>

                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>