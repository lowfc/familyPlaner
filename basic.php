<?php
require 'db.php';
$errors = array();
$d = $_POST;
$send = R::load('reggedusers', $_SESSION['logged_user']->id); // Загружаем запись db бд с нужным id
if (!password_verify($d['oldpassword'], $send->password)) {
    echo "
    <link rel='stylesheet' href='css/style.css'>
    <link href='https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap' rel='stylesheet'>
    <div class = 'errBlock'>
    <p>Неверно указан пароль</p>
    </div>
    <script src='notifProcessor.js'></script>
    <a href='/lk.php' style = 'color: green; margin: auto auto;'>Назад</a>
    ";
}
else{   

    if(isset($_FILES) && $_FILES['inputfile']['error'] == 0){ // Проверяем, загрузил ли пользователь файл
        $destiation_dir = dirname(__FILE__). '/res/avats' .'/'.$_FILES['inputfile']['name']; // Директория для размещения файла
        move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir ); // Перемещаем файл в желаемую директорию
    }
    else{
        $errors[] = 'avat';
    }

    if ($d['name'] == $_SESSION['logged_user']->name || trim($d['name']) == ''){ $errors[] = 'name'; }
    if ($d['middle_name'] == $_SESSION['logged_user']->middle_name || trim($d['middle_name']) == ''){ $errors[] = 'middle_name'; }
    if ($d['last_name'] == $_SESSION['logged_user']->last_name || trim($d['last_name']) == ''){ $errors[] = 'last_name'; }
    if ($d['family_status'] == $_SESSION['logged_user']->family_status || trim($d['family_status']) == ''){ $errors[] = 'family_status'; }
    if ($d['date_of_born'] == $_SESSION['logged_user']->date_of_born || trim($d['date_of_born']) == ''){ $errors[] = 'date_of_born'; }
    if (strlen(trim($d["newpassword"])) > 20 || strlen(trim($d["newpassword"])) < 8) { $errors[] = 'password'; }
    // Меняем поля
    if (!in_array('avat',$errors)) { $send->avat = '"/res/avats/'.$_FILES['inputfile']['name'].'"';}
    if (!in_array('name',$errors)) { $send->name = $d['name']; echo isset($errors['name']);}
    if (!in_array('middle_name',$errors)) { $send->middle_name = $d['middle_name'];}
    if (!in_array('last_name',$errors)) { $send->last_name = $d['last_name']; }
    if (!in_array('family_status',$errors)) { $send->family_status = $d['family_status']; }
    if (!in_array('date_of_born',$errors)) { $send->date_of_born = $d['date_of_born']; }
    if (!in_array('password', $errors)) { $send->password = password_hash($d['newpassword'], PASSWORD_DEFAULT); }
    R::store($send); // Записываем
    $_SESSION['logged_user'] = $send; //Перезаписываем данные сессии
    $_SESSION['logged_user']->greeting = 0;
    header('Location: /lk.php'); 

}

?>