<?php

if (isset($_POST['submit'])) {
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        $targetPath = __DIR__ . '/uploads/' . $_FILES['image']['name'];
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $uploadedImagePath = $targetPath;
            $im = imagecreatefromjpeg($uploadedImagePath);
            $im2 = imagecrop($im, ['x' => round(imagesx($im) / 2), 'y' => round(imagesy($im) / 2),
                'width' => $_POST['x'], 'height' => $_POST['y']]);
            if ($im2 !== FALSE) {
                header('Content-Type: image/jpeg');
                imagejpeg($im2);
                imagedestroy($im2);
            }
            imagedestroy($im);
        }
    }
}

require_once 'forms/script.php';
?>

<link rel="stylesheet" href="styles/formsStyle.css">
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="col-25">
            <label>Upload image </label>
        </div>
        <div class="col-75">
            <input type="file" name="image" />
        </div>

        <div class="col-25">
            <label>X </label>
        </div>
        <div class="col-75">
            <input type="number" name="x" />
        </div>

        <div class="col-25">
            <label>Y </label>
        </div>
        <div class="col-75">
            <input type="number" name="y" />
        </div>

        <div>
            <label><input type="submit" name="submit" /></label>
        </div>
    </form>
</div>

