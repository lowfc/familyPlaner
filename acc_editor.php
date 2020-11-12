<?php require 'db.php'; if (isset($_SESSION['logged_user'])) : ?>
<?php 
$succeful = TRUE;
if (isset($_POST['send']))
{
    $send = R::find('reggedusers', 'family_identifier LIKE ?' , [$_SESSION["logged_user"]->family_identifier]);
    foreach ($send as $s)
    {
        $current_user = R::findOne('reggedusers', 'id LIKE ?' , [$s->id]);
        if ($_POST['del'.$s->id]=='on')
        {
            R::trash(  R::load('reggedusers', $current_user->id) );
            if ($_SESSION["logged_user"]->id == $current_user->id)
            {
                $succeful = FALSE;
                header('Location: /login.php');
            }    
        }
        else
        {
            $current_user->user_group = $_POST[$s->id];
            if ($_POST[$s->id] == 'not_confirmed')
            {
                $succeful = FALSE;
                header('Location: /login.php');
            }
        }
        R::store($current_user);
    }
    if ($succeful)
    {
        header('Location: /lk.php?administration=');
    }
}

?>
<?php else : require 'acess_failed.php'; endif;?>