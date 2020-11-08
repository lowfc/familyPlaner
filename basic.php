<?php
if(isset($_FILES) && $_FILES['inputfile']['error'] == 0){ // Проверяем, загрузил ли пользователь файл
$destiation_dir = dirname(__FILE__). '/res/avats' .'/'.$_FILES['inputfile']['name']; // Директория для размещения файла
move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir ); // Перемещаем файл в желаемую директорию
header('Location: /lk.php');
}
else{
echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
}
?>