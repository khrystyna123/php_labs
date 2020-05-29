<?php

function getPublishedPosts() {
    global $conn;
    $sql = "SELECT * FROM posts WHERE published=true";
    $result = mysqli_query($conn, $sql);

    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $posts;
}

function getPost($slug){
    global $conn;
    $post_slug = $_GET['post-slug'];
    $sql = "SELECT * FROM posts WHERE slug='$post_slug' AND published=true";
    $result = mysqli_query($conn, $sql);

    $post = mysqli_fetch_assoc($result);

    return $post;
}
