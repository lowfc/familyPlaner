<?php if (isset($_SESSION['logged_user'])) : ?>
    <div class = 'rightBlock'>
        <form style='overflow: auto; padding: 10px 10px;' method="post" action="acc_editor.php" enctype="multipart/form-data">
                <p class="miniHeader">Аккаунты:</p>
                <?php if (isset($_SESSION['logged_user'])) : ?>
                <?php endif;?>
                <?php if ($_SESSION['logged_user']->skip_pass == 0) : ?>
                    <p class="miniHeader">Подтвердите, что это Вы:</p>
                    <input class="entryField" type="password" name="oldpassword" placeholder="Текущий пароль" value=""><br>
                <?php endif; ?>
                <div class="block_elems">
                        <button class='regButton' type="submit" value="send">Применить</button>
                </div>
        </form>
    </div>
<?php else : require 'acess_failed.php'; endif;?>