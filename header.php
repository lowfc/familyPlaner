<?php if (isset($_SESSION['logged_user'])) : ?>
<head>
		<title>Расчет бюджета</title>	
        <link rel="shortcut icon" href="res/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<div class='header'>
    <a href="/lk.php" class='logo_a'><img class='header_logo' src='res/logo.png'></a>
    <a href="/expenditure_category.php" class='head_a'>Категории расходов</a>
    <a href="/revenue.php" class='head_a_2'>Доходы</a>
    <a href="/expenses.php" class='head_a_1'>Расходы</a>
    <a href="/revenue_category.php" class='head_a_3'>Категории доходов</a>
    <a href="/lk.php" class='lk_logo'>
        <p class='name_header'><?php echo $_SESSION['logged_user']->name?></p>
        <img class='avat_logo' src = <?php echo $_SESSION['logged_user']->avat?>>
        <p class='name_header'><?php echo $_SESSION['logged_user']->family_identifier; ?></p>
    </a>
</div>
</head>
<?php else : require 'acess_failed.php'; endif;?>