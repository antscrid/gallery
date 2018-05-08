<?php
//Імпорт даних з json-файлу
$json_file = file_get_contents ('https://picsum.photos/list');

//Розшифрування json в якості асоціативного масиву
$jsonarray = json_decode($json_file,TRUE);

//Вибір 9 елементів масиву, починаючи з 257-го елемента
$json_part = array_slice($jsonarray, 256, 9, true);

//Створення функції для сортування елементів масиву по значенню 'filename'
function sortfunnction($a, $b){
    if ($a['filename'] == $b['filename']) {
        return 0;
    }
    return ($a['filename'] < $b['filename']) ? -1 : 1;
}
usort($json_part, "sortfunnction");

