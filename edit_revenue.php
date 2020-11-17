<? require 'murder.php'; require 'db.php';
if (isset($_POST['del']))
{
    kill($_POST['id'],'revenue');
    header('Location: revenue.php');
}
else if (isset($_POST['edit_revenue']))
{
    $tableRev = R::findOne('revenue', 'id LIKE ?' , [$_POST['id']]);
    $tableRev->amount_revenue = $_POST['amount'];
    $tableRev->date_revenue = $_POST['date_revenue'];
    $tableRev->revenue_initiator_id = $_POST['initiator'];
    $tableRev->family_identifier = $_SESSION["logged_user"]->family_identifier;
    R::store($tableRev);
    header("Location: /revenue.php");
}
?>
<?php require 'header.php';?>
<div style='margin: 0 auto;'>
        <form action="edit_revenue.php" method="POST">
            <input type='hidden' name='id' value="<?echo $_POST['id']?>">
                <p class="miniHeader">Изменение суммы дохода:</p>
                <input class="entryField" type="text" name="amount" placeholder="Сумма (руб.)" value="<?echo $_POST['amount']?>" required>
                <p class="miniHeader">Изменение даты дохода:</p>
                <input class="entryField" name="date_revenue" type="date" value="<?echo $_POST['date']?>" required>
                <p class="miniHeader">Изменение инициатора дохода:</p>
                <select name='initiator'>
                <?php
                echo "<option value=".$_POST['INITid'].">".$_POST['INITname']."</option>";
                    $send = R::find('reggedusers', 'family_identifier LIKE :ident AND user_group LIKE :er' , [':ident'=>$_SESSION["logged_user"]->family_identifier, ':er'=>'earner']);
                    foreach ($send as $s)
                    {
                        if ($s->name.' '.$s->last_name != $_POST['INITname'])
                        {
                            echo "<option value=$s->id>$s->name $s->last_name</option>";
                        }       
                    }
                ?>
                </select>
                <button class="regButton" name="edit_revenue" type="submit">Изменить</button>
        </form>
</div>