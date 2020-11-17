<?php require 'db.php'; require 'header.php'; require 'murder.php'?>
<?php if (isset($_SESSION['logged_user'])): ?>
<?
if (isset($_POST['del']))
{
    kill($_POST['id'],'expenses');
}
?>
<h1>Расходы</h1>
<div style='margin: 0 auto;'>
    <form action="expenses_sender.php" method="POST">
			<p class="miniHeader">Сумма расхода:</p>
            <input class="entryField" type="text" name="amount" placeholder="Сумма (руб.)" required>
            <p class="miniHeader">Дата расхода:</p>
            <input class="entryField" name="date_expenses" type="date" required>
            <p class="miniHeader">Инициатор расхода:</p>
            <select name='initiator'>
            <?php 
                $send = R::find('reggedusers', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
                foreach ($send as $s)
                {
                    echo "<option value=$s->id>$s->name $s->last_name</option>";
                }
            ?>
            </select>
            <p class="miniHeader">Категория расхода:</p>
            <select name='category'>
            <?php 
                $send = R::find('expenditurecategory', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
                foreach ($send as $s)
                {
                    echo "<option value=$s->id>$s->category_name</option>";
                }
            ?>
            </select>
			<button class="regButton" name="add_expenses" type="submit">Добавить</button>
	</form>
</div>
<?php
$send = R::find('expenses', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
foreach ($send as $i)
{
    $init = R::findOne('reggedusers', 'id LIKE ?' , [$i->expenses_initiator_id]);
    $cat = R::findOne('expenditurecategory', 'id LIKE ?' , [$i->expenses_category]);
    echo "
    <form action='expenses.php' method='post'>
    <div class='miniCard'>
    <center> <b> $i->amount_expenses руб.</b> ($i->date_expenses) </center> <br>
    <center><i>$init->last_name $init->name</i> </center> <br>
    <center>$cat->category_name</center>
    <input type='hidden' name='id' value='{$i->id}'>
    <button class='regButton' name='del' type='submit'>Удалить</button>
    </div>
    </form>
    ";
}
?>
<?php else: require 'acess_failed.php'; endif;?>