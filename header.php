<?php if (isset($_SESSION['logged_user'])) : ?>
<head>
		<title>Расчет бюджета</title>	
        <link rel="shortcut icon" href="res/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">
<div class='header'>
    <a href="/lk.php" class='logo_a'><img class='header_logo' src='res/logo.png'></a>
    <p class='name_header'><?php echo $_SESSION['logged_user']->name?></p>
    <img class='avat_logo' src = <?php echo $_SESSION['logged_user']->avat?>>
</div>
</head>
<?php else : require 'acess_failed.php'; endif;?>