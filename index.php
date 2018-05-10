<!DOCTYPE html>
<html>
	<head>
        <link rel="shortcut icon" href="http://www.iconarchive.com/download/i97958/thehoth/seo/seo-web-code.ico" type="image/ico">
        <link rel="stylesheet" href="../css/css.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/main.css">
        <?php
        //include_once 'php/script.php';
        include 'php/json_array.php';
        ?>
        <title><?php
            // Перевірка оголошення константи і змінної, виведення константи в  <title>
            if ((isset($data['url'])) && (defined('Title')) ) {
                echo 'Фото '. Title;
            }?>
        </title>
    </head>
	<body>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <div class="gallery">
        <!--Перебираємо масив для виведення елементів, які сформували на сторінці json_array-->
        <?php foreach ($pics as $data){ ?>
            <div>
                <div class="box">
                    <a data-fancybox="gallery"
                       href="<?php echo $data['url'] ?>">
                        <img class src="<?php echo $data['thumbnail'] ?>">
                    </a>
                    <div class="text-box">
                        <p><b>Created by: </b><?php echo $data['author'] ?></p>
                        <p><b>Created at: </b><?php echo $data['pics_date'] ?></p>
                    </div>
                </div>
            </div>
        <?php }; ?>

    </div>
    </body
</html>
