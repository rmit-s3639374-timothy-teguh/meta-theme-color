<?php
    include 'functions.php';
    try{
        $db = null;
        $db = new pdo('mysql:unix_socket=/cloudsql/meta-theme-color:australia-southeast1:mtc-database;dbname=mtc', 'root', '');


        $select = $db->prepare('SELECT color, today FROM mtc.entries ORDER BY color');
        $select->execute();
        $result = $select->fetchAll();

        $b = $result[0][1];
        $c = $result[1][1];
        $g = $result[2][1];
        $m = $result[3][1];
        $r = $result[4][1];
        $y = $result[5][1];

        // if($b + $c + $g + $m + $r + $y == 0){
        //     // Day won't be reset because nobody participated
        //     exit();
        // }

        $winner = determine_winner($b, $c, $g, $m, $r, $y);
        if(isset($winner)){
            if($winner == "E"){
                $update = $db->prepare('UPDATE mtc.users SET points = points + 1 WHERE today_color IS NOT NULL');
                $update->execute();
            }
            else{
                $update = $db->prepare('UPDATE mtc.users SET points = points + 1 WHERE today_color = ?');
                $update->execute(array($winner));
            }
        }
        $update = $db->prepare('UPDATE mtc.entries SET yesterday = today WHERE 1=1');
        $update->execute();

        $update = $db->prepare('UPDATE mtc.entries SET today = 0 WHERE 1=1');
        $update->execute();

        $update = $db->prepare('UPDATE mtc.users SET yesterday_color = today_color WHERE 1=1');
        $update->execute(array());

        $update = $db->prepare('UPDATE mtc.users SET today_color = null WHERE 1=1');
        $update->execute(array());

        $db = null;
    }catch(PDOException $ex){
        exit($ex->getMessage());
    }
?>