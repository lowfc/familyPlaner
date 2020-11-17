<?php
function kill($id, $tablename)
{

    $c = R::findOne($tablename, 'id LIKE ?' , [$id]);
    R::trash( R::load($tablename, $c->id) );

}
?>