<?php require 'db.php';
require 'header.php'; ?>
<?php if($_SESSION['logged_user']->greeting == 1) : ?>
<div class = 'succBlock'>
    <p>Здравствуйте, <?php echo $_SESSION['logged_user']->name;?>!</p>
</div>
<script src="notifProcessor.js"></script>
<?php $_SESSION['logged_user']->greeting = 0; endif; ?>
<main>
    <?php

if (isset($_SESSION['logged_user'])) : ?>

<?php

if (isset($_GET['prof_sett']))
{
    require 'profile_settings.php';
}
else if (isset($_GET['administration']))
{
    echo '';
}
else if (isset($_GET['report']))
{
    echo '';
}

?>
    <div class='leftBlock'>
        <form action='lk.php'>
            <div class = 'divisor'>
                <img class='avatar' src = <?php echo $_SESSION['logged_user']->avat?>>
                <p class='nameHeader'>[<?php echo $_SESSION['logged_user']->family_status?>]</p>
        
                <p class='nameHeader'><?php echo
                $_SESSION['logged_user']->last_name, ' ',
                $_SESSION['logged_user']->name, ' ',
                $_SESSION['logged_user']->middle_name;
                ?></p>
            </div>
            <div class="block_elems">
                <button class='bt' name='administration' type = 'submit'>Управление учетными записями</button>
                <button class='bt' name='prof_sett' type = 'submit'>Настройка профиля</button>
                <button class='bt' name='report' type = 'submit'>Загрузка отчетов</button>
                <a class='bt' href='logout.php'>Выйти</a>
            </div>
        </form>
    </div>

</main>
<?php else : require 'acess_failed.php'; endif;?>



