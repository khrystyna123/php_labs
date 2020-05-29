<?php

$user_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";
$errors = [];

if (isset($_POST['create_user'])) {
    createUser($_POST);
}

if (isset($_GET['edit-user'])) {
    $isEditingUser = true;
    $user_id = $_GET['edit-user'];
    editUser($user_id);
}

if (isset($_POST['update_user'])) {
    updateUser($_POST);
}

if (isset($_GET['delete-user'])) {
    $user_id = $_GET['delete-user'];
    deleteUser($user_id);
}

function createUser($request_values){
    global $conn, $errors, $role, $username, $email;
    $username = esc($request_values['username']);
    $email = esc($request_values['email']);
    $password = esc($request_values['password']);
    $passwordConfirmation = esc($request_values['passwordConfirmation']);

    if(isset($request_values['role'])){
        $role = esc($request_values['role']);
    }
    if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
    if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
    if (empty($role)) { array_push($errors, "Role is required for admin users");}
    if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }
    if ($password != $passwordConfirmation) { array_push($errors, "The two passwords do not match"); }

    $user_check_query = "SELECT * FROM users WHERE username='$username' 
							OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "INSERT INTO users (username, email, role, password) 
				  VALUES('$username', '$email', '$role', '$password')";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "User created successfully";
        header('location: users.php');
        exit(0);
    }
}

function editUser($user_id)
{
    global $conn, $username, $role, $isEditingUser, $user_id, $email;

    $sql = "SELECT * FROM users WHERE id=$user_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result);

    $username = $admin['username'];
    $email = $admin['email'];
}

function updateUser($request_values){
    global $conn, $errors, $role, $username, $isEditingUser, $user_id, $email;
    $user_id = $request_values['user_id'];
    $isEditingUser = false;

    $username = esc($request_values['username']);
    $email = esc($request_values['email']);
    $password = esc($request_values['password']);
    $passwordConfirmation = esc($request_values['passwordConfirmation']);
    if(isset($request_values['role'])){
        $role = $request_values['role'];
    }
    if (count($errors) == 0) {
        $password = md5($password);

        $query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE id=$user_id";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "User updated successfully";
        header('location: users.php');
        exit(0);
    }
}

function deleteUser($user_id) {
    global $conn;
    $sql = "DELETE FROM users WHERE id=$user_id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "User successfully deleted";
        header("location: users.php");
        exit(0);
    }
}

function getUsers(){
    global $conn, $roles;
    $sql = "SELECT * FROM users WHERE role IS NOT NULL";
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $users;
}

function esc(String $value){
    global $conn;

    $val = trim($value);
    $val = mysqli_real_escape_string($conn, $value);
    return $val;
}

function makeSlug(String $string){
    $string = strtolower($string);
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return $slug;
}