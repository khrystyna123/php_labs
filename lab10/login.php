<?php  include('config.php'); ?>
<?php  include('includes/registration_login.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Логін</title>
    <link rel="stylesheet" type="text/css" href="static/css/register_style.css">
</head>
<body>
<div class="header">
    <h2>Логін</h2>
</div>

<form method="post" action="login.php">
    <?php include('includes/errors.php'); ?>
    <div class="input-group">
        <label>Ім'я користувача</label>
        <input type="text" name="username" >
    </div>
    <div class="input-group">
        <label>Пароль</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Увійти</button>
    </div>
    <p>
        Ще не зареєстровані? <a href="register.php">Зареєструватися</a>
    </p>
</form>
</body>
</html>
