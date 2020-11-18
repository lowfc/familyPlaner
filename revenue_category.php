<?php require 'db.php'; require 'header.php'; require 'murder.php'?>
<?php if (isset($_SESSION['logged_user'])): ?>

<h1>Категории доходов</h1>
<div style='margin: 0 auto;'>
    <form action="rev_category_sender.php" method="POST">
			<p class="miniHeader">Название:</p>
			<input class="entryField" type="text" name="category_name" placeholder="Название категории" required>
			<p class="miniHeader">Описание:</p>
            <input class="entryField" type="text" name="discription" placeholder="Описание категории" required>
			<button class="regButton" name="add_category" type="submit">Добавить</button>
	</form>
</div>
<?php
$send = R::find('revenuecategory', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
foreach ($send as $i)
{
    echo "
    <form action='edit_rev_cat.php' method='post'>
    <div class='miniCard'>
    <input type='hidden' name='id' value='{$i->id}'>
    <center> <b> $i->name </b></center> <br>
    <center><i>$i->discription</i> </center>
    <input type='hidden' name='id' value='{$i->id}'>
    <input type='hidden' name='name' value='{$i->name}'>
    <input type='hidden' name='discription' value='{$i->discription}'>
    <button class='regButton' name='del' type='submit'>Удалить</button>
    <button class='regButton' name='change_tape' type='submit'>Изменить</button>
    </div>
    </form>
    ";
}
?>
<?php else: require 'acess_failed.php'; endif;?>