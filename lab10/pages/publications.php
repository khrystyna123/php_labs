<?php require_once('../config.php') ?>
<?php require_once('../includes/public_functions.php') ?>
<?php require_once('../includes/registration_login.php') ?>
<?php $posts = getPublishedPosts(); ?>
<?php require_once('../includes/header.php') ?>

    <div class="container">
    <?php include('../includes/navbar.php') ?>

    <div class="content">
        <?php
        session_start();

        if (!isset($_SESSION['user'])) {
            echo
            '<div style="text-align: right">
                <a href="../login.php">Логін</a>
                <a href="../register.php">Реєстрація</a>
            </div>';

        }
        else {
            echo '<div style="text-align: right">
                    <a href="../users/index.php">Особистий кабінет</a>
                  </div>';
        }
        ?>

        <hr>
        <?php foreach ($posts as $post): ?>
            <div class="post" style="margin-left: 0px;">
                <img src="../static/images/' . $post['image']; ?>" class="post_image" alt="">
                <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
                    <div class="post_info">
                        <h3><?php echo $post['title'] ?></h3>
                        <div class="info">
                            <span class="read_more">Читати більше...</span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach ?>
    </div>

<?php include('../includes/footer.php') ?>