<?php require 'db.php'; require 'header.php';?>
<?php if (isset($_SESSION['logged_user'])): ?>

<?
if (isset($_POST['setCount']))
{
    $ALLREV = 0;
    $EXPERIOD = 0;
    $bool = TRUE;

    $query = R::getAll('SELECT amount_revenue FROM revenue WHERE date_revenue <="'.$_POST['of_date'].'"');
    foreach ($query as $i)
    {
        $ALLREV+=$i->amount_revenue;
    }  
    $query = R::getAll('SELECT amount_expenses FROM expenses WHERE date_expenses <="'.$_POST['of_date'].'"');
    foreach ($query as $i)
    {
        $EXPERIOD += $i['amount_expenses'];
    }   
    $BUDGET = $ALLREV - $EXPERIOD;
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
<p>За выбранный период бюджет семьи будет составлять <?echo $BUDGET;?> рублей</p>
</div>
<? endif; ?>
<?php else: require 'acess_failed.php'; endif;?>