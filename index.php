<!DOCTYPE html>
<html>
	<head>
        <?php
        define ("Title", "Галерея", false);
        // Значення <title> додане в якості константи
        ?>
        <title><?php
            echo Title;
            // Значення <title> виведене, як константа
            ?>
        </title>
    </head>
	<body>
    <link rel="stylesheet" href="css/style.css">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
        <div class="gallery">
            <?php
            $Img_link='https://fakeimg.pl/250x150/'
            // Посилання на зображення додане, як змінна
            ?>
            <a data-fancybox="gallery" href= '<?php echo $Img_link?>'>
                <img src="<?php echo $Img_link?>"></a>
            <!--Посилання виведене, як змінна-->
            <a data-fancybox="gallery" href= '<?php echo $Img_link?>'>
                <img src="<?php echo $Img_link?>"></a>
            <a data-fancybox="gallery" href= '<?php echo $Img_link?>'>
                <img src="<?php echo $Img_link?>"></a>
            <a data-fancybox="gallery" href= '<?php echo $Img_link?>'>
                <img src="<?php echo $Img_link?>"></a>
            <a data-fancybox="gallery" href= '<?php echo $Img_link?>'>
                <img src="<?php echo $Img_link?>"></a>
            <a data-fancybox="gallery" href= '<?php echo $Img_link?>'>
                <img src="<?php echo $Img_link?>"></a>
            <a data-fancybox="gallery" href= '<?php echo $Img_link?>'>
                <img src="<?php echo $Img_link?>"></a>
            <a data-fancybox="gallery" href= '<?php echo $Img_link?>'>
                <img src="<?php echo $Img_link?>"></a>
            <a data-fancybox="gallery" href= '<?php echo $Img_link?>'>
                <img src="<?php echo $Img_link?>"></a>
        </div>
    </body
</html>
