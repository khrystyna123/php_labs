<?php

$username = "";
$email    = "";
$errors = array();

if (isset($_POST['reg_user'])) {
    $username = esc($_POST['username']);
    $email = esc($_POST['email']);
    $password_1 = esc($_POST['password_1']);
    $password_2 = esc($_POST['password_2']);

    if (empty($username)) { array_push($errors, "Введіть ім'я користувача"); }
    if (empty($email)) { array_push($errors, "Введіть email"); }
    if (empty($password_1)) { array_push($errors, "Введіть пароль"); }
    if ($password_1 != $password_2) {
        array_push($errors, "Паролі не співпадають");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Таке ім'я вже існує");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Такий email вже існує");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1);
        $query = "INSERT INTO users (username, email, password) 
					  VALUES('$username', '$email', '$password')";
        mysqli_query($conn, $query);

        $reg_user_id = mysqli_insert_id($conn);

        $_SESSION['user'] = getUserById($reg_user_id);

        if ($_SESSION['user']['role'] == "admin") {
            header('location: admin/dashboard.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Вітаємо, Ви успішно зареєстровані!!!";
            header('location: index.php');
            exit(0);
        }
    }
}

if (isset($_POST['login_user'])) {
    $username = esc($_POST['username']);
    $password = esc($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Введіть ім'я користувача");
    }
    if (empty($password)) {
        array_push($errors, "Введіть пароль");
    }
    if (empty($errors)) {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $reg_user_id = mysqli_fetch_assoc($result)['id'];

            $_SESSION['user'] = getUserById($reg_user_id);

            if ($_SESSION['user']['role'] == "admin") {
                header('location: admin/dashboard.php');
                exit(0);
            } else {
                header('location: users/index.php');
                exit(0);
            }
        } else {
            array_push($errors, 'Wrong credentials');
        }
    }
}

function esc(string $value)
{
    global $conn;

    $val = trim($value);
    $val = mysqli_real_escape_string($conn, $value);

    return $val;
}

function getUserById($id)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    return $user;
}