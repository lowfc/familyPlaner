<?php
require 'db.php';
if (!isset($_SESSION['logged_user']))
{
    echo "
				<div class = 'errBlock'>
				<p>Cессия упала</p>
                </div>
                <div style='margin: 0 auto;'><img src='/res/working.png'><p class='miniHeader'>Нет прав для просмотра этой страницы</p></div>
				";
}
else
{
    echo "
				<div class = 'succBlock'>
                <p>Сессия встала</p>
                </div> 
                <h1>Эта страница еще в работе</h1>
                <center><p class='miniHeader'>Но Вы успешно вошли в личный кабинет, ".$_SESSION['logged_user']->name.".</p></center>
				";
}
?>
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<div><a class="btn_register" href="/logout.php">Выйти</a></div>