<?php
/*
$bdd=new PDO ('mysql:host=localhost;dbname=jeuxvideo_db','root','');

*/
try {
    $bdd = new PDO('mysql:host=localhost;dbname=jeuxvideo_db', 'root', '');
} catch (Exception $e) {
    echo $e;
}