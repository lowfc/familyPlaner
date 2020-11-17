<? require 'murder.php'; require 'db.php';?>
<?php
if (isset($_POST['del']))
{
    kill($_POST['id'],'expenditurecategory');
}
if (isset($_POST['edit_exp']))
{
    $tableRev = R::findOne('expenditurecategory', 'id LIKE ?' , [$_POST['id']]);
    $tableRev->category_name = $_POST['category_name'];
    $tableRev->discription = $_POST['discription'];
    $tableRev->importance = $_POST['importance'];
    R::store($tableRev);
    header("Location: /expenditure_category.php");
}
?>
<?php require 'header.php';?>
<div style='margin: 0 auto;'>
        <form action="edit_exp_cat.php" method="POST">
        <input type='hidden' name='id' value="<?echo $_POST['id']?>">
        <p class="miniHeader">Изменить название:</p>
			<input class="entryField" type="text" name="category_name" placeholder="Название категории" value="<?echo $_POST['name']?>" required>
			<p class="miniHeader">Изменить описание:</p>
            <input class="entryField" type="text" name="discription" placeholder="Описание категории" value="<?echo $_POST['discription']?>" required>
            <p class="miniHeader">Изменить класс важности:</p>
            <select name='importance'>
                <?php
                echo "<option value=".$_POST['class'].">".$_POST['class']."</option>";
                    foreach (array(1,2,3,4,5) as $s)
                    {
                        if ($s != $_POST['class'])
                        {
                            echo "<option value=$s>$s</option>";
                        }       
                    }
                ?>
                </select>
            <button class="regButton" name="edit_exp" type="submit">Изменить</button>
        </form>
</div>