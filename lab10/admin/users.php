<?php  include('../config.php'); ?>
<?php  include('admin_functions.php'); ?>
<?php
$admins = getUsers();
$roles = ['admin', 'user'];
?>
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
    </div>
    <div class="user-info">
        <a href="../users/registration/logout.php" class="logout-btn">Вихід</a>
    </div>
</div>
<div class="container content">
    <div class="action">
        <h1 class="page-title">Додати/Редагувати Користувача</h1>

        <form method="post" action="<?php echo 'users.php'; ?>" >

            <?php include('../includes/errors.php') ?>

            <?php if ($isEditingUser === true): ?>
                <input type="hidden" name="admin_id" value="<?php echo $user_id; ?>">
            <?php endif ?>

            <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
            <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="passwordConfirmation" placeholder="Password confirmation">
            <select name="role">
                <option value="" selected disabled>Assign role</option>
                <?php foreach ($roles as $key => $role): ?>
                    <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                <?php endforeach ?>
            </select>

            <?php if ($isEditingUser === true): ?>
                <button type="submit" class="btn" name="update_user">Оновити</button>
            <?php else: ?>
                <button type="submit" class="btn" name="create_user">Зберегти Користувача</button>
            <?php endif ?>
        </form>
    </div>

    <div class="table-div">
        <?php include('../includes/messages.php') ?>

            <table class="table">
                <thead>
                <th>N</th>
                <th>Користувач</th>
                <th>Роль</th>
                <th colspan="2">Редагувати/Видалити</th>
                </thead>
                <tbody>
                <?php foreach ($admins as $key => $admin): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td>
                            <?php echo $admin['username']; ?>, &nbsp;
                            <?php echo $admin['email']; ?>
                        </td>
                        <td><?php echo $admin['role']; ?></td>
                        <td>
                            <a class="fa fa-pencil btn edit"
                               href="users.php?edit-user=<?php echo $admin['id'] ?>">
                            </a>
                        </td>
                        <td>
                            <a class="fa fa-trash btn delete"
                               href="users.php?delete-user=<?php echo $admin['id'] ?>">
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
    </div>
</div>
</body>
</html>