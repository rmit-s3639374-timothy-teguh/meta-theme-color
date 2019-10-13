<?php
    try{
        $db = null;
        $db = new pdo('mysql:unix_socket=/cloudsql/meta-theme-color:australia-southeast1:mtc-database;dbname=mtc', 'root', '');

        $update = $db->prepare('UPDATE mtc.users SET today_color = null WHERE email = ?');
        $update->execute(array("phoenixon911@gmail.com"));

    }catch(PDOException $ex){
        exit($ex->getMessage());
    }
?>