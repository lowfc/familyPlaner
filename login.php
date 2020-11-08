<?php
require 'logout.php';
if (isset($_POST['go_log'])){  
    $try_login = R::findOne('reggedusers', 'phone = ?', array($_POST['phone']));
    if ( $try_login ){
        if (password_verify($_POST['password'], $try_login->password)) 
		{ 
				$_SESSION['logged_user'] = $try_login;
				$_SESSION['logged_user']->greeting = 1;
				header('Location: /lk.php');
        }
        else{
            echo "
				<div class = 'errBlock'>
				<p>Неверно введен пароль</p>
				</div>
				";
        }
    }
    else{
        echo "
				<div class = 'errBlock'>
				<p>Такой логин не зарегестрирован</p>
				</div>
				";
    }
}
?>


<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<div class="bigBlock">       
	<div class="f_center">
		<h1>Вход</h1>
		<form action="login.php" method="POST">
			<p class="miniHeader">Телефон:</p>
			<input class="entryField" type="text" name="phone" placeholder='Ваш логин'><br>
			<p class="miniHeader">Пароль:</p>
			<input class="entryField" type="password" name="password" placeholder="Ваш пароль"><br>
			<button class="regButton" name="go_log" type="submit">Войти</button>
		</form>
		<a class="btn_register" href="/index.php">Зарегистрироваться</a>
	</div>
</div>