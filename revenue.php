<?php require 'db.php'; require 'header.php';?>
<?php if (isset($_SESSION['logged_user'])): ?>
<h1>Доходы</h1>
    <div style='margin: 0 auto;'>
        <form action="revenue_sender.php" method="POST">
                <p class="miniHeader">Сумма дохода:</p>
                <input class="entryField" type="text" name="amount" placeholder="Сумма (руб.)" required>
                <p class="miniHeader">Дата дохода:</p>
                <input class="entryField" name="date_revenue" type="date" id="ss_2" required>
                <p class="miniHeader">Инициатор дохода:</p>
                <select name='initiator'>
                <?php 
                    $send = R::find('reggedusers', 'family_identifier LIKE :ident AND user_group LIKE :er' , [':ident'=>$_SESSION["logged_user"]->family_identifier, ':er'=>'earner']);
                    foreach ($send as $s)
                    {
                        echo "<option value=$s->id>$s->name $s->last_name</option>";
                    }
                ?>
                </select>
                <p class="miniHeader" id="fd">Класс дохода:</p>
                <select name='class'>
                <?php 
                    $send = R::find('revenuecategory', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
                    foreach ($send as $s)
                    {
                        echo "<option value=$s->id>$s->name</option>";
                    }
                ?>
                </select>
                <button class="regButton" name="add_revenue" type="submit" id="kn_2">Добавить</button>
        </form>
    </div>
<?php
$send = R::find('revenue', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
foreach ($send as $i)
{
    $init = R::findOne('reggedusers', 'id LIKE ?' , [$i->revenue_initiator_id]);
    $init2 = R::findOne('revenuecategory', 'id LIKE ?' , [$i->category_id]);
    echo "
    <form action='edit_revenue.php' method='post'>
    <div class='miniCard' id='rya'>
    <center> <b> $i->amount_revenue руб.</b> ($i->date_revenue) </center> <br>
    <center><i>$init->last_name $init->name</i> </center>  <br>
    <center>$init2->name </center>
    <input type='hidden' name='id' value='{$i->id}'>
    <input type='hidden' name='amount' value='{$i->amount_revenue}'>
    <input type='hidden' name='date' value='{$i->date_revenue}'>
    <input type='hidden' name='INITname' value='{$init->name} {$init->last_name}'>
    <input type='hidden' name='INITid' value='{$init->id}'>
    <button class='regButton' name='del' type='submit' id='dl'>Удалить</button>
    <button class='regButton' name='change_tape' type='submit'>Изменить</button>
    </div>
    </form>
    
    ";
}
?>
<?php else: require 'acess_failed.php'; endif;?>