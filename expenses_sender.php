<?php
require 'db.php';
if (isset($_POST['add_expenses']))
{
    $tableRev = R::dispense('expenses');
    $tableRev->name = $_POST['name'];
    $tableRev->amount_expenses = $_POST['amount'];
    $tableRev->date_expenses = $_POST['date_expenses'];
    $tableRev->expenses_initiator_id = $_POST['initiator'];
    $tableRev->family_identifier = $_SESSION["logged_user"]->family_identifier;
    $tableRev->expenses_category = $_POST['category'];
    R::store($tableRev);
    header("Location: /expenses.php");
}
?>