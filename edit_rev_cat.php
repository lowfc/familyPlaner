<? require 'murder.php'; require 'db.php';?>
<?php
if (isset($_POST['del']))
{
    kill($_POST['id'],'revenuecategory');
}
if (isset($_POST['edit_rev']))
{
    $tableRev = R::findOne('revenuecategory', 'id LIKE ?' , [$_POST['id']]);
    $tableRev->name = $_POST['name'];
    $tableRev->discription = $_POST['discription'];
    R::store($tableRev);
    header("Location: /revenue_category.php");
}
?>
<?php require 'header.php';?>
<div style='margin: 0 auto;'>
        <form action="edit_rev_cat.php" method="POST">
        <input type='hidden' name='id' value="<?echo $_POST['id']?>">
        <p class="miniHeader">Изменить название:</p>
			<input class="entryField" type="text" name="name" placeholder="Название категории" value="<?echo $_POST['name']?>" required>
			<p class="miniHeader">Изменить описание:</p>
            <input class="entryField" type="text" name="discription" placeholder="Описание категории" value="<?echo $_POST['discription']?>" required>
            <button class="regButton" name="edit_rev" type="submit">Изменить</button>
        </form>
</div>