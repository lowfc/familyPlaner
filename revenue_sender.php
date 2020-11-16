<?php
require 'db.php';
if (isset($_POST['add_revenue']))
{
    $tableRev = R::dispense('revenue');
    $tableRev->amount_revenue = $_POST['amount'];
    $tableRev->date_revenue = $_POST['date_revenue'];
    $tableRev->revenue_initiator_id = $_POST['initiator'];
    $tableRev->family_identifier = $_SESSION["logged_user"]->family_identifier;
    R::store($tableRev);
    header("Location: /revenue.php");
}
?>