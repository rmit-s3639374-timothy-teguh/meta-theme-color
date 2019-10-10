<?php
    try{
        $db = null;
        $db = new pdo('mysql:unix_socket=/cloudsql/meta-theme-color:australia-southeast1:mtc-database;dbname=mtc', 'root', '');
        //$db = new mysqli(null, 'root', 'namnamnam', 'mtc', null, '/cloudsql/meta-theme-color:australia-southeast1:mtc-database');

        $sth = $db->prepare('SELECT today FROM mtc.entries WHERE color = "r"');
        $sth->execute();
        $result = $sth->fetchAll();
        $today = $result[0][0];

        $stmt = $db->prepare('UPDATE mtc.entries SET today = ? WHERE color = "r"');
        $stmt->execute(array($today + 1));
        //$affected_rows = $stmt->rowCount();

        //echo $affected_rows;

        $db = null;

    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
    header('Location: wait');
?>