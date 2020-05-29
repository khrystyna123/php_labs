<?php

$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$post_slug = "";
$body = "";
$featured_image = "";

function getAllPosts()
{
    global $conn;

    if ($_SESSION['user']['role'] == "admin") {
        $sql = "SELECT * FROM posts";
    } elseif ($_SESSION['user']['role'] == "user") {
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT * FROM posts WHERE user_id=$user_id";
    }
    $result = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();
    foreach ($posts as $post) {
        $post['user'] = getPostAuthorById($post['user_id']);
        array_push($final_posts, $post);
    }
    return $final_posts;
}

function getPostAuthorById($user_id)
{
    global $conn;
    $sql = "SELECT username FROM users WHERE id=$user_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result)['username'];
    } else {
        return null;
    }
}

if (isset($_POST['create_post'])) {
    createPost($_POST);
}

if (isset($_GET['edit-post'])) {
    $isEditingPost = true;
    $post_id = $_GET['edit-post'];
    editPost($post_id);
}

if (isset($_POST['update_post'])) {
    updatePost($_POST);
}

if (isset($_GET['delete-post'])) {
    $post_id = $_GET['delete-post'];
    deletePost($post_id);
}

function createPost($request_values)
{
    global $conn, $errors, $title, $featured_image, $body, $published;
    $title = esc($request_values['title']);
    $body = htmlentities(esc($request_values['body']));

    if (isset($request_values['publish'])) {
        $published = esc($request_values['publish']);
    }
    $post_slug = makeSlug($title);
    if (empty($title)) {
        array_push($errors, "Post title is required");
    }
    if (empty($body)) {
        array_push($errors, "Post body is required");
    }
    $featured_image = $_FILES['featured_image']['name'];
    if (empty($featured_image)) {
        array_push($errors, "Featured image is required");
    }
    $target = "../static/images/" . basename($featured_image);
    if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
        array_push($errors, "Failed to upload image. Please check file settings for your server");
    }
    $post_check_query = "SELECT * FROM posts WHERE slug='$post_slug' LIMIT 1";
    $result = mysqli_query($conn, $post_check_query);

    if (mysqli_num_rows($result) > 0) {
        array_push($errors, "A post already exists with that title.");
    }

    if (count($errors) == 0) {
        $query = "INSERT INTO posts (user_id, title, slug, image, body, published) VALUES(1, '$title', '$post_slug', '$featured_image', '$body', $published)";
        if (mysqli_query($conn, $query)) {
            $inserted_post_id = mysqli_insert_id($conn);

            $_SESSION['message'] = "Post created successfully";
            header('location: posts.php');
            exit(0);
        }
    }
}

function editPost($role_id)
{
    global $conn, $title, $post_slug, $body, $published, $isEditingPost, $post_id;
    $sql = "SELECT * FROM posts WHERE id=$role_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);
    $title = $post['title'];
    $body = $post['body'];
    $published = $post['published'];
}

function updatePost($request_values)
{
    global $conn, $errors, $post_id, $title, $featured_image, $body, $published;

    $title = esc($request_values['title']);
    $body = esc($request_values['body']);
    $post_id = esc($request_values['post_id']);
    $post_slug = makeSlug($title);

    if (empty($title)) {
        array_push($errors, "Post title is required");
    }
    if (empty($body)) {
        array_push($errors, "Post body is required");
    }
    if (isset($_POST['featured_image'])) {
        $featured_image = $_FILES['featured_image']['name'];
        $target = "../static/images/" . basename($featured_image);
        if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
            array_push($errors, "Failed to upload image. Please check file settings for your server");
        }
    }

    if (count($errors) == 0) {
        $query = "UPDATE posts SET title='$title', slug='$post_slug', views=0, image='$featured_image', body='$body', published=$published WHERE id=$post_id";
        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = "Стаття успішно створена";
            header('location: posts.php');
            exit(0);
        }
        $_SESSION['message'] = "Стаття успішно оновлена";
        header('location: posts.php');
        exit(0);
    }
}

function deletePost($post_id)
{
    global $conn;
    $sql = "DELETE FROM posts WHERE id=$post_id";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Стаття успішно видалена";
        header("location: posts.php");
        exit(0);
    }
}

if (isset($_GET['publish']) || isset($_GET['unpublish'])) {
    $message = "";
    if (isset($_GET['publish'])) {
        $message = "Стаття успішно опублікована";
        $post_id = $_GET['publish'];
    } else if (isset($_GET['unpublish'])) {
        $message = "Стаття успішно видалена";
        $post_id = $_GET['unpublish'];
    }
    togglePublishPost($post_id, $message);
}

function togglePublishPost($post_id, $message)
{
    global $conn;
    $sql = "UPDATE posts SET published=!published WHERE id=$post_id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = $message;
        header("location: posts.php");
        exit(0);
    }
}