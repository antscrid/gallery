<!DOCTYPE html>
<html>
	<head>
        <link rel="shortcut icon" href="http://www.iconarchive.com/download/i97958/thehoth/seo/seo-web-code.ico" type="image/ico">
        <link rel="stylesheet" href="../css/css.css">
        <?php
        include_once 'php/script.php';
        include_once 'php/json_array.php';
        ?>
        <title><?php
            if ( (isset($Img_link)) && (defined('Title')) ) {
                echo 'Фото '.Title;
            }
            // Перевірка оголошення константи і змінної, виведення константи в  <title>
            ?>
        </title>
    </head>
	<body>
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <div class="right"></div>
    <div class="gallery">
        <!-- Цикл для перебору елементів отриманого масиву з 9 елементів та їх виведення у посиланнях і картинках -->
        <?php foreach($json_part as $key => $value){
               echo "<a data-fancybox=\"gallery\" href=". $value['post_url'] . '/download' .">" . "<img src=". $value['post_url'] . '/download' .">" . "</a>";
    };
    ?>
    </div>
    <div class="right"></div>
    </body
</html>
