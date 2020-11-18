<?php
require 'db.php';
if (isset($_POST['add_category']))
{
    $tableCat = R::dispense('revenuecategory');
    $tableCat->name = $_POST['category_name'];
    $tableCat->discription = $_POST['discription'];
    $tableCat->family_identifier = $_SESSION["logged_user"]->family_identifier;
    R::store($tableCat);
    header("Location: /revenue_category.php");
}
?>