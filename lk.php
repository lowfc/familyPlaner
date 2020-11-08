<?php
require 'db.php';
if (isset($_SESSION['logged_user'])) : ?>

<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<?php if($_SESSION['logged_user']->greeting == 1) : ?>
<div class = 'succBlock'>
    <p>Здравствуйте, <?php echo $_SESSION['logged_user']->name;?> !</p>
</div>
<script src="notifProcessor.js"></script>
<?php $_SESSION['logged_user']->greeting = 0; endif; ?>
<!--
<form method="post" action="basic.php" enctype="multipart/form-data">
<label for="inputfile">Upload File</label>
<input type="file" id="inputfile" name="inputfile"></br>
<input type="submit" value="Click To Upload">
</form>
-->

<div class='leftBlock'>
    <div class = 'divisor'>
        <img class='avatar' src = <?php echo $_SESSION['logged_user']->avat?>>
        <p class='nameHeader'>[<?php echo $_SESSION['logged_user']->family_status?>]</p>

        <p class='nameHeader'><?php echo
        $_SESSION['logged_user']->last_name, ' ',
        $_SESSION['logged_user']->name, ' ',
        $_SESSION['logged_user']->middle_name;
        ?></p>
    </div>
    <a class='out'>Управление учетными записями</a>
    <a class='out'>Настройка профиля</a>
    <a class='out'>Загрузка отчетов</a>
    <a class='out' href='logout.php'>Выйти</a>
</div>
<?php else : require 'acess_failed.php'; endif;?>
