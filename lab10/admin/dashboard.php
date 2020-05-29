<?php  include('../config.php'); ?>
<?php include('admin_functions.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Averia+Serif+Libre|Noto+Serif|Tangerine" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/admin_style.css" type="text/css">
    <title>Адмінка</title>
</head>
<body>
<div class="header">
    <div class="logo">
        <h1>Адмінка</h1>
    </div>
    <?php if (isset($_SESSION['user'])): ?>
        <div class="user-info">
            <span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp;
            <a href="../logout.php" class="logout-btn">Вихід</a>
        </div>
    <?php endif ?>
</div>
<div class="container dashboard">
    <div class="stats">
        <a href="users.php" class="first">
            <span>Користувачі</span>
        </a>
        <a href="../users/posts.php">
            <span>Опубліковаі статті</span>
        </a>
    </div>
    <br><br><br>
    <div class="buttons">
        <a href="users.php">Додати користувачів</a>
    </div>
</div>
</body>
</html>
