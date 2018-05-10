<?php
define ("Title", "Галерея", false);
//Імпорт даних з json-файлу
    $json_file = file_get_contents('https://picsum.photos/list');

//Розшифрування json в якості асоціативного масиву
    $jsonarray = json_decode($json_file, TRUE);

//Вибір 9 елементів масиву, починаючи з 257-го елемента
    $json_part = array_slice($jsonarray, 257, 9, true);

    //Створення нового масиву для зручного оперування і додавання ключів та значень
    $pics = [];
function date_and_time()
{
    return date('d M Y H:i:s', time());
}
//Створення функції для сортування елементів масиву по даті й часу
function sortfunction($a, $b)
{
    if ($a['filename'] == $b['filename']) {
        return 0;
    }
    return ($a['filename'] < $b['filename']) ? -1 : 1;
}
usort($json_part, "sortfunction");
    //Перебираємо масив для виведення елементів
    foreach ($json_part as $key => $value) {
        $img_url = ($value['post_url'] . '/download');
        $size = getimagesize("$img_url");
        $pics[] = [
            "url" => $img_url,
            //"thumbnail" => generateThumbnail($img_url, $width, $height),
            "thumbnail" => $img_url,
            "author" => $value['author'],
            "width" => $value['width'],
            "height" => $value['height'],
            //Виведення масиву про дату через ф-цю
            "pics_date" => date_and_time(),
            //Виведення масиву про дату через ф-цю
            //'size' => $size,
        ];
        //Умова для перевірки наявності шляху до зображення
    }
function imageExists($imagePath)
{
    if (isset($imagePath) && !empty($imagePath)) {
        return $imagePath;
    } else {
        return "https://picsum.photos/250/150?image=20";
    }
}
/** Generate image thumbnail in base64
 *
 * @param $imagePath
 * @param $width
 * @param $height
 * @return string
 */
function generateThumbnail($imagePath, &$width, &$height)
{
    $params = getOriginalSize($imagePath);
    return 'data:' . $params['mime'] . ';base64,' . base64_encode(resizeImage($imagePath, $width, $height, $params));
}
/** Resize Image
 *
 * @param $imagePath
 * @param $width
 * @param $height
 * @param $params
 * @return string
 */
function resizeImage($imagePath, &$width, &$height, $params)
{
    $mime = $params['mime'];
    //use specific function based on image format
    switch ($mime) {
        case 'image/jpeg':
            $imageCreateFunc = 'imagecreatefromjpeg';
            $imageSaveFunc = 'imagejpeg';
            break;
        case 'image/png':
            $imageCreateFunc = 'imagecreatefrompng';
            $imageSaveFunc = 'imagepng';
            break;
        case 'image/gif':
            $imageCreateFunc = 'imagecreatefromgif';
            $imageSaveFunc = 'imagegif';
            break;
        default:
            //we will handle this once work with errors
    }
    //Variable function
    $img = $imageCreateFunc($imagePath);
    //list is php construction that allows to set array elements to variables
    list($originalWidth, $originalHeight) = $params;
    //calculate height
    if (!$height) {
        $height = ($originalHeight / $originalWidth) * $width;
    }
    //create new image
    $bufferImage = imagecreatetruecolor($width, $height);
    imagecopyresampled($bufferImage, $img, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
    //save original image size to variables for later use outside of function
    $width = $originalWidth;
    $height = $originalHeight;
    //return buffer output as string
    ob_start();
    $imageSaveFunc($bufferImage);
    return ob_get_clean();
}
/** get image size info
 *
 * @param $imagePath
 * @return array|bool
 */
function getOriginalSize($imagePath)
{
    return getimagesize($imagePath);
}