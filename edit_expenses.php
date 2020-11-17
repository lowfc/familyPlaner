<? require 'murder.php'; require 'db.php';?>
<?
if (isset($_POST['del']))
{
    kill($_POST['id'],'expenses');
}
if (isset($_POST['edit_expenses']))
{
    $tableRev = R::findOne('expenses', 'id LIKE ?' , [$_POST['id']]);
    $tableRev->amount_expenses = $_POST['amount'];
    $tableRev->date_expenses = $_POST['date_expenses'];
    $tableRev->expenses_initiator_id = $_POST['initiator'];
    $tableRev->family_identifier = $_SESSION["logged_user"]->family_identifier;
    R::store($tableRev);
    header("Location: /expenses.php");
}
?>
<?php require 'header.php';?>
<div style='margin: 0 auto;'>
        <form action="edit_expenses.php" method="POST">
            <input type='hidden' name='id' value="<?echo $_POST['id']?>">
                <p class="miniHeader">Изменение названия расхода:</p>
                <input class="entryField" type="text" name="name" placeholder="Название" value="<?echo $_POST['amount']?>" required>
                <p class="miniHeader">Изменение суммы расхода:</p>
                <input class="entryField" type="text" name="amount" placeholder="Сумма (руб.)" value="<?echo $_POST['amount']?>" required>
                <p class="miniHeader">Изменение даты расхода:</p>
                <input class="entryField" name="date_expenses" type="date" value="<?echo $_POST['date']?>" required>
                <p class="miniHeader">Изменение инициатора расхода:</p>
                <select name='initiator'>
                <?php
                echo "<option value=".$_POST['INITid'].">".$_POST['INITname']."</option>";
                    $send = R::find('reggedusers', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
                    foreach ($send as $s)
                    {
                        if ($s->name.' '.$s->last_name != $_POST['INITname'])
                        {
                            echo "<option value=$s->id>$s->name $s->last_name</option>";
                        }       
                    }
                ?>
                </select>
                <button class="regButton" name="edit_expenses" type="submit">Изменить</button>
        </form>
</div>
