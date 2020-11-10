<?php if (isset($_SESSION['logged_user'])) : ?>
    <div class = 'rightBlock'>
        <form style='overflow: auto; padding: 10px 10px;' method="post" action="acc_editor.php" enctype="multipart/form-data">
                <p class="regHeader">Аккаунты:</p><br><br>
                <?php 
                $send = R::find('reggedusers', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
                foreach ($send as $s)
                {
                    echo "
                    <div class='cardUser'>
                    <div style='width:33%;'>
                    <p class='miniHeader'>$s->name $s->last_name</p>
                    </div>
                    <div style='width:33%; padding-top:6px;'>
                    <select name='$s->id'>
                    ";
                    if ($s->user_group=='not_confirmed')
                    {
                        echo"
                        <option value='not_confirmed'>Не подтвержден</option>
                        <option value='earner'>Зарабатывающий</option>
                        <option value='dependent'>Еждивенец</option>
                        ";
                    }
                    else if ($s->user_group=='earner')
                    {
                        echo"
                        <option value='earner'>Зарабатывающий</option>
                        <option value='dependent'>Еждивенец</option>
                        <option value='not_confirmed'>Не подтвержден</option>
                        ";
                    }
                    else
                    {
                        echo"
                        <option value='dependent'>Еждивенец</option>
                        <option value='not_confirmed'>Не подтвержден</option>
                        <option value='earner'>Зарабатывающий</option>
                        ";
                    }
                    echo"
                    </select>
                    </div>
                    <div style='width:33%; padding:8px;'>
                    <input type='checkbox' name='del$s->id'> <p style='margin-top: -14px;'>Удалить</p>
                    </div>
                    </div>
                    ";
                }
                ?>
                <?php if ($_SESSION['logged_user']->skip_pass == 0) : ?>
                    <p class="miniHeader">Подтвердите, что это Вы:</p>
                    <input class="entryField" type="password" name="oldpassword" placeholder="Текущий пароль" value=""><br>
                <?php endif; ?>
                <div class="block_elems">
                        <button class='regButton' type="submit" name="send">Применить</button>
                </div>
        </form>
    </div>
<?php else : require 'acess_failed.php'; endif;?>