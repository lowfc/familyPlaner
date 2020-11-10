<?php
require 'logout.php';
$db = $_POST;
if (isset($db['go_reg']))
{
	$errors = array();
	if (R::find('reggedusers', 'phone LIKE ?' , [$db["phone"]]))
	{
		$errors[] = "Такой логин уже существует.";
		echo "
		<div class = 'errBlock'>
		<p></p>
		</div>
		";
	}
	if ($db["password"] != $db["reppassword"])
	{
		$errors[] = "Пароли не совпадают.";
	}
	if (trim($db["name"]) == '') {$errors[] = "Заполните поле имя.";}
	if (trim($db["last_name"]) == '') {$errors[] = "Заполните поле фамилия.";}
	if (trim($db["phone"]) == '') {$errors[] = "Заполните поле телефон.";}
	if (trim($db["password"]) == '') {$errors[] = "Заполните поле пароль.";}
	else if (strlen(trim($db["password"])) > 20) {$errors[] = "Пароль слишком длинный.";}
	else if (strlen(trim($db["password"])) < 8) {$errors[] = "Пароль слишком короткий.";}
	if (trim($db["family_identifier"]) == '') {$errors[] = "Заполните идентификатор семьи.";}
	if (trim($db["date_of_born"]) == '') {$errors[] = "Заполните дату рождения.";}

	if (empty($errors)){
		$tableUsers = R::dispense('reggedusers');
		$tableUsers->name = trim($db['name']);
		$tableUsers->last_name = trim($db['last_name']);
		$tableUsers->middle_name = trim($db['middle_name']);
		$tableUsers->phone = trim($db['phone']);
		$tableUsers->password = password_hash($db['password'], PASSWORD_DEFAULT);
		$tableUsers->family_identifier = trim($db['family_identifier']);
		$tableUsers->date_of_born = trim($db['date_of_born']);
		$tableUsers->avat = '/res/avats/default.jpg';
		if (R::find('reggedusers', 'family_identifier LIKE ?' , [$db["family_identifier"]]))
		{
			$tableUsers->user_group = 'not_confirmed';
		}
		else{
			$tableUsers->user_group = 'earner';
		}
		
		R::store($tableUsers);
		echo "
				<div class = 'succBlock'>
				<p>Успешная регистрация!</p>
				</div>
				";
	}
	else{
		$marg_incrementer = 0;
		foreach ($errors as $e)
			{
				echo "
				<div class = 'errBlock' style='margin-top:".$marg_incrementer."px;'>
				<p>$e</p>
				</div>
				";
				$marg_incrementer += 70;
			}
	}
}	
?>
<script src="notifProcessor.js"></script>
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<div class="bigBlock">       
	<div class="f_center">
		<h1>Регистрация</h1>
		<form action="register.php" method="POST">
			<p class="miniHeader">Телефон:</p>
			<input class="entryField" type="login" name="phone" placeholder="Он будет использован как логин"><br>
			<p class="miniHeader">Пароль:</p>
			<input class="entryField" type="password" name="password" placeholder="Пароль (От 8 до 20 символов)" value=""><br>
			<input class="entryField" type="password" name="reppassword" placeholder="Подтвердите пароль" value=""><br>
			<p class="miniHeader">Ваши данные:</p>
			<input class="entryField" type="text" name="last_name" placeholder="Фамилия" value=""><br>
			<input class="entryField" type="text" name="name" placeholder="Имя" value=""><br>
			<input class="entryField" type="text" name="middle_name" placeholder="Отчество (можно оставить пустым)" value=""><br>
			<p class="miniHeader">Дата рождения:</p>
			<input class="entryField" name="date_of_born" type="date" required><br>
			<p class="miniHeader">Идентификатор Вашей семьи:</p>
			<input class="entryField" type="text" name="family_identifier" placeholder="Введите или придумайте" value=""><br>
			<button class="regButton" name="go_reg" type="submit">Регистрация</button>
		</form>
		<a class="bt" href="/login.php">Логин</a><br><br><br>
	</div>
</div>
