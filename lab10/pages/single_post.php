<?php  include('../config.php'); ?>
<?php  include('../includes/public_functions.php'); ?>
<?php
if (isset($_GET['post-slug'])) {
    $post = getPost($_GET['post-slug']);
}
?>
<?php include('../includes/header.php'); ?>

    <body>
<div class="container">
    <?php include('../includes/navbar.php'); ?>

    <hr>
    <div class="content" >
        <div class="post-wrapper">
            <div class="full-post-div">
                <?php if ($post['published'] == false): ?>
                    <h2 class="post-title">Ця стаття не опублікована</h2>
                <?php else: ?>
                    <h2 class="post-title"><?php echo $post['title']; ?></h2>
                    <div class="post-body-div">
                        <?php echo html_entity_decode($post['body']); ?>
                    </div>
                <?php endif ?>
            </div>

        </div>

    </div>
</div>

<?php include('../includes/footer.php'); ?>