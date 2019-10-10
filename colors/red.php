<?php
    include 'functions.php';
    
    try{
        $db = null;
        $db = new pdo('mysql:unix_socket=/cloudsql/meta-theme-color:australia-southeast1:mtc-database;dbname=mtc', 'root', '');
        //$db = new mysqli(null, 'root', 'namnamnam', 'mtc', null, '/cloudsql/meta-theme-color:australia-southeast1:mtc-database');

        $select = $db->prepare('SELECT today FROM mtc.entries WHERE color = "r"');
        $select->execute();
        $result = $select->fetchAll();
        $today = $result[0][0];

        $update = $db->prepare('UPDATE mtc.entries SET today = ? WHERE color = "r"');
        $update->execute(array($today + 1));
        //$affected_rows = $stmt->rowCount();

        //echo $affected_rows;

        $db = null;

    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
    header('Location: wait');
?>