<?php  include('../config.php'); ?>
<?php  include('post_functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Особистий кабінет</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/admin_style.css">
</head>

<?php $posts = getAllPosts(); ?>
<body>

<div class="container content">

    <div class="table-div"  style="width: 80%;">
        <?php include('../includes/messages.php') ?>

        <?php if (empty($posts)): ?>
            <h1 style="text-align: center; margin-top: 20px;">Немає статей у базі</h1>
        <?php else: ?>
            <table class="table">
                <thead>
                <th>N</th>
                <th>Назва</th>
                <th>Автор</th>
                <th>Перегляди</th>
                <?php if ($_SESSION['user']['role'] == "user"): ?>
                    <th><small>Публікація</small></th>
                <?php endif ?>
                <th><small>Оновлення</small></th>
                <th><small>Видалення</small></th>
                </thead>
                <tbody>
                <?php foreach ($posts as $key => $post): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $post['author']; ?></td>
                        <td>
                            <a 	target="_blank"
                                  href="<?php echo '../pages/single_post.php?post-slug=' . $post['slug'] ?>">
                                <?php echo $post['title']; ?>
                            </a>
                        </td>
                        <td><?php echo $post['views']; ?></td>

                        <?php if ($_SESSION['user']['role'] == "Admin" ): ?>
                            <td>
                                <?php if ($post['published'] == true): ?>
                                    <a class="fa fa-check btn unpublish"
                                       href="posts.php?unpublish=<?php echo $post['id'] ?>">
                                    </a>
                                <?php else: ?>
                                    <a class="fa fa-times btn publish"
                                       href="create_post.php?publish=<?php echo $post['id'] ?>">
                                    </a>
                                <?php endif ?>
                            </td>
                        <?php endif ?>

                        <td>
                            <a class="fa fa-pencil btn edit"
                               href="create_post.php?edit-post=<?php echo $post['id'] ?>">
                            </a>
                        </td>
                        <td>
                            <a  class="fa fa-trash btn delete"
                                href="create_post.php?delete-post=<?php echo $post['id'] ?>">
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</div>
</body>
</html>