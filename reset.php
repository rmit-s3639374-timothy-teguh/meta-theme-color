<?php
    try{
        $db = null;
        $db = new pdo('mysql:unix_socket=/cloudsql/meta-theme-color:australia-southeast1:mtc-database;dbname=mtc', 'root', '');

        $update = $db->prepare('UPDATE mtc.entries SET yesterday = today WHERE 1=1');
        $update->execute();

        $update = $db->prepare('UPDATE mtc.entries SET today = 0 WHERE 1=1');
        $update->execute();

        $update = $db->prepare('UPDATE mtc.users SET yesterday_color = today_color WHERE 1=1');
        $update->execute(array());

        $update = $db->prepare('UPDATE mtc.users SET today_color = null WHERE 1=1');
        $update->execute(array());

    }catch(PDOException $ex){
        exit($ex->getMessage());
    }
?>