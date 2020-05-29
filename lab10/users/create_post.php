<?php  include('../config.php'); ?>
<?php  include('post_functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Особистий кабінет</title>
    <link rel="stylesheet" type="text/css" href="../static/css/admin_style.css">
</head>

<body>

<div class="container content">

    <div class="action create-post-div">
        <h1 class="page-title">Створити/Оновити Статтю</h1>
        <form method="post" enctype="multipart/form-data" action="create_post.php" >
            <?php include('../includes/errors.php') ?>

            <?php if ($isEditingPost === true): ?>
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <?php endif ?>

            <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Назва">
            <label style="float: left; margin: 5px auto 5px;">Зображення</label>
            <input type="file" name="featured_image" >
            <textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>

                <?php if ($published == true): ?>
                    <label for="publish">
                        Опублікувати
                        <input type="checkbox" value="1" name="publish" checked="checked">&nbsp;
                    </label>
                <?php else: ?>
                    <label for="publish">
                        Опублікувати
                        <input type="checkbox" value="1" name="publish">&nbsp;
                    </label>
                <?php endif ?>

            <?php if ($isEditingPost === true): ?>
                <button type="submit" class="btn" name="update_post">Оновити</button>
            <?php else: ?>
                <button type="submit" class="btn" name="create_post">Зберегти Статтю</button>
            <?php endif ?>

        </form>
    </div>
</div>
</body>
</html>
