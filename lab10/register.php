<?php  include('config.php'); ?>
<?php  include('includes/registration_login.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Реєстрація</title>
    <link rel="stylesheet" type="text/css" href="static/css/register_style.css">
</head>
<body>
<div class="header">
    <h2>Реєстрація</h2>
</div>

<form method="post" action="register.php">
    <?php include('includes/errors.php'); ?>
    <div class="input-group">
        <label>Ім'я користувача</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
        <label>Пароль</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Підтвердіть пароль</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Зареєструватися</button>
    </div>
    <p>
        Вже зареєстровані? <a href="login.php">Увійти</a>
    </p>
</form>
</body>
</html>
