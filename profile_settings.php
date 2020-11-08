
<div class = 'rightBlock'>
    <form method="post" action="basic.php" enctype="multipart/form-data">
            <label for="inputfile">Выберите аватарку</label>
            <input type="file" id="inputfile" name="inputfile"><br>
            <p class="miniHeader">Ваши данные:</p>
            <input class="entryField" type="text" name="last_name" placeholder="Фамилия" value="<?php echo $_SESSION['logged_user']->last_name; ?>"><br>
            <input class="entryField" type="text" name="name" placeholder="Имя" value="<?php echo $_SESSION['logged_user']->name; ?>"><br>
            <input class="entryField" type="text" name="middle_name" placeholder="Отчество (можно оставить пустым)" value="<?php echo $_SESSION['logged_user']->middle_name; ?>"><br>
            <p class="miniHeader">Дата рождения:</p>
			<input class="entryField" name="date_of_born" type="date" value = "<?php echo $_SESSION['logged_user']->date_of_born; ?>"><br>
			<p class="miniHeader">Роль в Семье:</p>
            <input class="entryField" type="text" name="family_status" placeholder="Например: Мама" value= "<?php echo $_SESSION['logged_user']->family_status; ?>"><br>
            <p class="miniHeader">Сменить пароль:</p>
            <input class="entryField" type="password" name="newpassword" placeholder="Новый пароль" value=""><br>
            <p class="miniHeader">Подтвердите, что это Вы:</p>
			<input class="entryField" type="password" name="oldpassword" placeholder="Текущий пароль" value=""><br>
        <button class='regButton' type="submit" value="send">Применить</button>
    </form>
</div>