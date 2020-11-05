<?php
require 'db.php'; 
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
	if (trim($db["family_status"]) == '') {$errors[] = "Заполните поле статус.";}
	if (trim($db["date_of_born"]) == '') {$errors[] = "Заполните дату рождения.";}

	if (empty($errors)){
		$tableUsers = R::dispense('reggedusers');
		$tableUsers->name = trim($db['name']);
		$tableUsers->last_name = trim($db['last_name']);
		$tableUsers->middle_name = trim($db['middle_name']);
		$tableUsers->phone = trim($db['phone']);
		$tableUsers->password = password_hash($db['password'], PASSWORD_DEFAULT);
		$tableUsers->family_status = trim($db['family_status']);
		$tableUsers->deate_of_born = trim($db['date_of_born']);
		$tableUsers->vk = trim($db['vk']);
		$tableUsers->user_group = 'not confirmed';
		R::store($tableUsers);
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

<link rel="stylesheet" href="css/style.css">
<div class="bigBlock">       
	<p class="regHeader">Регистрация</p>
	<div>
		<form action="register.php" method="POST">
			<p class="miniHeader">Телефон</p>
			<input class="entryField" type="text" name="phone" placeholder="+71234567890" value=""><br>
			<p class="miniHeader">Пароль</p>
			<input class="entryField" type="password" name="password" placeholder="Пароль (От 8 до 20 символов)" value=""><br>
			<input class="entryField" type="password" name="reppassword" placeholder="Подтвердите пароль" value=""><br>
			<p class="miniHeader">Ваши данные</p>
			<input class="entryField" type="text" name="last_name" placeholder="Фамилия" value=""><br>
			<input class="entryField" type="text" name="name" placeholder="Имя" value=""><br>
			<input class="entryField" type="text" name="middle_name" placeholder="Отчество (можно оставить пустым)" value=""><br>
			<p class="miniHeader">Дата рождения</p>
			<input class="entryField" name="date_of_born" type="date" required><br>
			<p class="miniHeader">Статус в Семье</p>
			<input class="entryField" type="text" name="family_status" placeholder="Например: Мама" value=""><br>
			<p class="miniHeader">Интеграция с ВК</p>
			<input class="entryField" type="text" name="vk" placeholder="Ссылка на профиль ВК (можно оставить пустым)" value=""><br>
			<p>
				<button class="regButton" name="go_reg" type="submit">Регистрация</button>
			</p>		
		</form>
		<a class="btn_register" href="/index.php">Вернуться на главную</a><br><br><br>
	</div>
</div>