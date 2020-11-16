<?php require 'db.php'; require 'header.php';?>
<?php if (isset($_SESSION['logged_user'])): ?>
<h1>Доходы</h1>
<div style='margin: 0 auto;'>
    <form action="revenue_sender.php" method="POST">
			<p class="miniHeader">Сумма дохода:</p>
            <input class="entryField" type="text" name="amount" placeholder="Сумма (руб.)" required>
            <p class="miniHeader">Дата дохода:</p>
            <input class="entryField" name="date_revenue" type="date" required>
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
			<button class="regButton" name="add_revenue" type="submit">Добавить</button>
	</form>
</div>
<?php
$send = R::find('revenue', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
foreach ($send as $i)
{
    $init = R::findOne('reggedusers', 'id LIKE ?' , [$i->revenue_initiator_id]);
    echo "
    <div class='miniCard'>
    <center> <b> $i->amount_revenue руб.</b> ($i->date_revenue) </center> <br>
    <center><i>$init->last_name $init->name</i> </center>
    </div>
    ";
}
?>
<?php else: require 'acess_failed.php'; endif;?>