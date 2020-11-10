<?php 

if (isset($_POST['ch_fId']))
{  
require 'db.php';
$send = R::load('reggedusers', $_SESSION['logged_user']->id);
if (R::find('reggedusers', 'family_identifier LIKE ?' , [$_POST["family_identifier"]]))
	{
		$send->user_group = 'not_confirmed';
	}
else
    {
		$send->user_group = 'earner';
    }
$send->family_identifier = $_POST["family_identifier"];
R::store($send);
header('Location: /login.php');
}
?>

<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<div style='margin: 0 auto;'>
    <p class='miniHeader' style = 'text-align: center;'>Ваш аккаунт еще не подтвердил ни один из членов семьи.</p>
</div>
<br><br><br><br>
<form action="not_confirmed.php" method="POST" style='width:320px;margin: 0 auto;'>
    <p class="miniHeader">Если Вы ошиблись, Вы можете его сменить</p>
    <input class="entryField" type="text" name="family_identifier" placeholder="Введите или придумайте" value=""><br>
    <button class="regButton" name="ch_fId" type="submit">Изменить</button>
</form>