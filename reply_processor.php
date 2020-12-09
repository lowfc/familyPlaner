<?php if (isset($_SESSION['logged_user'])) : ?>
    <div class = 'rightBlock'>
        <form action='_get_reply.php'>
        <button class='bt' name='revenue' type = 'submit'>Доходы</button>
        <button class='bt' name='expenses' type = 'submit'>Расходы</button>
        <button class='bt' name='revenuecategory' type = 'submit'>Категории доходов</button>
        <button class='bt' name='expenditurecategory' type = 'submit'>Категории расходов</button>
        </form>
    </div>
<?php else : require 'acess_failed.php'; endif;?>