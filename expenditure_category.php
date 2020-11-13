<?php require 'db.php'; require 'header.php';?>
<?php if (isset($_SESSION['logged_user'])): ?>
<h1>Категории расходов</h1>
<div style='margin: 0 auto;'>
    <form action="category_sender.php" method="POST">
			<p class="miniHeader">Название:</p>
			<input class="entryField" type="text" name="category_name" placeholder="Название категории" required>
			<p class="miniHeader">Описание:</p>
            <input class="entryField" type="text" name="discription" placeholder="Описание категории" required>
            <p class="miniHeader">Класс важности:</p>
            <select name='importance'>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            </select>
			<button class="regButton" name="add_category" type="submit">Добавить</button>
	</form>
</div>
<?php
$send = R::find('expenditurecategory', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
foreach ($send as $i)
{
    echo "
    <div class='miniCard'>
    <center> <b> $i->category_name </b> ($i->importance к.в.) </center> <br>
    <center><i>$i->discription</i> </center>
    </div>
    ";
}
?>
<?php else: require 'acess_failed.php'; endif;?>