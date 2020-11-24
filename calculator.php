<?php require 'db.php'; require 'header.php';?>
<?php if (isset($_SESSION['logged_user'])): ?>

<?
if (isset($_POST['setCount']))
{
    $ALLREV = 0;
    $EXPERIOD = 0;
    $bool = TRUE;
    $ZARABOT = 0;
    $ZARABOT_С = 0;
    $TRAT = 0;
    $TRAT_С = 0;
    $AV_CLASS = 0;
    $query = R::getAll('SELECT amount_revenue FROM revenue WHERE date_revenue <="'.$_POST['of_date'].'"');
    foreach ($query as $i)
    {
        $ALLREV+=$i['amount_revenue'];
    }  
    $query = R::getAll('SELECT amount_expenses FROM expenses WHERE date_expenses <="'.$_POST['of_date'].'"');
    foreach ($query as $i)
    {
        $EXPERIOD += $i['amount_expenses'];
    }   
    $BUDGET = $ALLREV - $EXPERIOD;
    $query = R::getAll('SELECT amount_revenue FROM revenue WHERE date_revenue >="'.$_POST['of_date'].'"'.' AND date_revenue <="'.$_POST['to_date'].'"');
    foreach ($query as $i)
    {
        $ZARABOT += $i['amount_revenue'];
        $ZARABOT_С ++;
    } 
    $query = R::getAll('SELECT amount_expenses FROM expenses WHERE date_expenses >="'.$_POST['of_date'].'"'.' AND date_expenses <="'.$_POST['to_date'].'"');
    foreach ($query as $i)
    {
        $TRAT += $i['amount_expenses'];
        $TRAT_С ++;
    } 
    $query = R::getAll('SELECT expenses_category FROM expenses WHERE date_expenses >="'.$_POST['of_date'].'"'.' AND date_expenses <="'.$_POST['to_date'].'"');
    foreach ($query as $i)
    {
        $send = R::findOne('expenditurecategory', 'family_identifier LIKE :ident AND id LIKE :id' , [':ident'=>$_SESSION["logged_user"]->family_identifier,':id'=>$i['expenses_category']]);
        $AV_CLASS+=$send->importance;
    } 
    $AV_CLASS /= $TRAT_С;
}
?>

<h1>Планирование</h1>
<form ACTION = 'calculator.php' method='POST'>
<div style='display:flex; padding-top: auto; margin: 0 auto; width:650px;'>
<p class='p_flex'>Показать в период с</p>
<input class="entryField" name="of_date" type="date" style='width: 150px;' required>
<p class='p_flex'>по</p>
<input class="entryField" name="to_date" type="date" style='width: 150px;' required>
<button name='setCount' type='submit'>Отобразить</button>
</div>
</form>
<?php if (isset($bool)): ?>
<div class="bigBlock">
<table>
    <tr>
        <td>Бюджет по наступлению выбранного периода</td> 
        <td <?
        if ($BUDGET < 0) {echo 'style="background: red;"';}
        else if ($BUDGET == 0) {echo 'style="background: yellow;"';}
        else {echo 'style="background: green;"';}
        ?>><?echo $BUDGET;?> рублей</td>
    </tr>
    <tr>
        <td>Заработок за выбранный период</td> 
        <td <?
        if ($BUDGET == 0) {echo 'style="background: red;"';}
        else {echo 'style="background: green;"';}
        ?>
        ><?echo $ZARABOT;?> рублей</td>
    </tr>
    <tr>
        <td
        >Траты за выбранный период</td> 
        <td
        <?
        if ($TRAT>$ZARABOT) {echo 'style="background: red;"';}
        else {echo 'style="background: green;"';}
        ?>
        ><?echo $TRAT;?> рублей</td>
    </tr>
    <tr>
        <td>Средний класс важности трат за период</td> 
        <td
        <?
        if ($AV_CLASS >= 4) {echo 'style="background: green;"';}
        else if ($AV_CLASS < 4 and $AV_CLASS > 2.5) {echo 'style="background: yellow;"';}
        else {echo 'style="background: red;"';}
        ?>
        ><?echo round($AV_CLASS, 2);?></td>
    </tr>
    <tr>
        <td>Всего трат за период</td> 
        <td><?echo $TRAT_С;?></td>
    </tr>
    <tr>
        <td>Всего поступлений в бюджет за период</td> 
        <td><?echo $ZARABOT_С;?></td>
    </tr>
    <tr>
        <td>ИТОГО бюджет на конец периода</td> 
        <td
        <?
        if ($BUDGET - $TRAT + $ZARABOT > 0 ) {echo 'style="background: green;"';}
        else if ($BUDGET - $TRAT + $ZARABOT == 0) {echo 'style="background: yellow;"';}
        else {echo 'style="background: red;"';}
        ?>
        ><?echo $BUDGET - $TRAT + $ZARABOT;?></td>
    </tr>
</table>



</div>
<? endif; ?>
<?php else: require 'acess_failed.php'; endif;?>