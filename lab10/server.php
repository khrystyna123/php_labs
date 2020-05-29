<?php
session_start();

$username = "";
$email    = "";
$errors = array();

$db = mysqli_connect('localhost', 'root', '111', 'hrushevskuy');

if (isset($_POST['reg_user'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


    if (empty($username)) { array_push($errors, "Введіть ім'я користувача"); }
    if (empty($email)) { array_push($errors, "Введіть email"); }
    if (empty($password_1)) { array_push($errors, "Введіть пароль"); }
    if ($password_1 != $password_2) {
        array_push($errors, "Паролі не співпадають");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
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

        if (isset($_POST['role'])) {
            $user_role = e($_POST['role']);
            $query = "INSERT INTO users (username, email, role, password) 
					  VALUES('$username', '$email', '$user_role', '$password')";
            mysqli_query($db, $query);
            $_SESSION['success']  = "Створено нового користувача!!";
            header('location: admin/dashboard.php');
        }else{
            $query = "INSERT INTO users (username, email, role, password) 
					  VALUES('$username', '$email', 'user', '$password')";
            mysqli_query($db, $query);

            $logged_in_user_id = mysqli_insert_id($db);

            $_SESSION['user'] = getUserById($logged_in_user_id);
            $_SESSION['success']  = "Вітаємо, Ви успішно зареєстровані!!!";
            header('location: index.php');
        }
    }
}

function getUserById($id){
    global $db;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = mysqli_query($db, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}

function e($val){
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: login.php");
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Введіть ім'я користувача");
    }
    if (empty($password)) {
        array_push($errors, "Введіть пароль");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $logged_in_user = mysqli_fetch_assoc($results);
            if ($logged_in_user['role'] == 'admin') {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "Вхід пройшов успішно!!!";
                header('location: admin/dashboard.php');
            }else{
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "Вхід пройшов успішно!!!";
                header('location: index.php');
            }
        }else {
            array_push($errors, "Неправильний логін та/або пароль");
        }
    }
}

function validateRole($role, $ignoreFields) {
    global $conn;
    $errors = [];
    foreach ($role as $key => $value) {
        if (in_array($key, $ignoreFields)) {
            continue;
        }
        if (empty($role[$key])) {
            $errors[$key] = "Це обов'зкове поле!!!";
        }
    }
    return $errors;
}

