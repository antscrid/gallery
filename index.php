<!DOCTYPE html>
<html>
	<head>
        <?php
        include_once 'php/script.php';
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
    <link rel="stylesheet" href="css/style.css">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
        <div class="gallery">
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
