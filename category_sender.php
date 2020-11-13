<?php
require 'db.php';
if (isset($_POST['add_category']))
{
    $tableCat = R::dispense('expenditurecategory');
    $tableCat->category_name = $_POST['category_name'];
    $tableCat->discription = $_POST['discription'];
    $tableCat->importance = $_POST['importance'];
    $tableCat->family_identifier = $_SESSION["logged_user"]->family_identifier;
    R::store($tableCat);
    header("Location: /expenditure_category.php");
}
?>