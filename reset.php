<?php
    include 'functions.php';

    use google\appengine\api\mail\Message;

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

        if($b + $c + $g + $m + $r + $y == 0){
            // Day won't be reset because nobody participated
            exit();
        }

        $winner = determine_winner($b, $c, $g, $m, $r, $y);
        if(isset($winner)){
            // Someone won
            if($winner == "E"){
                $update = $db->prepare('UPDATE mtc.users SET points = points + 1 WHERE today_color IS NOT NULL');
                $update->execute();

                $select = $db->prepare('SELECT email FROM mtc.users WHERE today_color IS NOT NULL');
                $select->execute();
                $result = $select->fetchAll();
                $count = count($result);
                for ($x = 0; $x < $count; $x++) {
                    try {
                        $message = new Message();
                        $message->setSender('no-reply@meta-theme-color.appspotmail.com');
                        $message->addTo($result[$x][0]);
                        $message->setSubject('Meta Theme Color: Everyone Won!');
                        $message->setTextBody('Victory! Perfectly balanced as all things should be. Please check https://meta-theme-color.appspot.com/stats for more details.');
                        $message->send();
                    } catch (InvalidArgumentException $e) {
                        exit($e->getMessage());
                    }
                } 
            }
            else{
                $update = $db->prepare('UPDATE mtc.users SET points = points + 1 WHERE today_color = ?');
                $update->execute(array($winner));

                // Winner emails
                $select = $db->prepare('SELECT email FROM mtc.users WHERE today_color = ?');
                $select->execute(array($winner));
                $result = $select->fetchAll();
                $count = count($result);
                for ($x = 0; $x < $count; $x++) {
                    try {
                        $message = new Message();
                        $message->setSender('no-reply@meta-theme-color.appspotmail.com');
                        $message->addTo($result[$x][0]);
                        if($winner == "b"){
                            $message->setSubject('Meta Theme Color: Blue Won!');
                            $message->setTextBody('Victory! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "c"){
                            $message->setSubject('Meta Theme Color: Cyan Won!');
                            $message->setTextBody('Victory! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "g"){
                            $message->setSubject('Meta Theme Color: Green Won!');
                            $message->setTextBody('Victory! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "m"){
                            $message->setSubject('Meta Theme Color: Magenta Won!');
                            $message->setTextBody('Victory! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "r"){
                            $message->setSubject('Meta Theme Color: Red Won!');
                            $message->setTextBody('Victory! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "y"){
                            $message->setSubject('Meta Theme Color: Yellow Won!');
                            $message->setTextBody('Victory! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        $message->send();
                    } catch (InvalidArgumentException $e) {
                        exit($e->getMessage());
                    }
                }

                // Loser emails
                $select = $db->prepare('SELECT email FROM mtc.users WHERE today_color != ? AND today_color IS NOT NULL');
                $select->execute(array($winner));
                $result = $select->fetchAll();
                $count = count($result);
                for ($x = 0; $x < $count; $x++) {
                    try {
                        $message = new Message();
                        $message->setSender('no-reply@meta-theme-color.appspotmail.com');
                        $message->addTo($result[$x][0]);
                        if($winner == "b"){
                            $message->setSubject('Meta Theme Color: Blue Won!');
                            $message->setTextBody('Defeat! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "c"){
                            $message->setSubject('Meta Theme Color: Cyan Won!');
                            $message->setTextBody('Defeat! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "g"){
                            $message->setSubject('Meta Theme Color: Green Won!');
                            $message->setTextBody('Defeat! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "m"){
                            $message->setSubject('Meta Theme Color: Magenta Won!');
                            $message->setTextBody('Defeat! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "r"){
                            $message->setSubject('Meta Theme Color: Red Won!');
                            $message->setTextBody('Defeat! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        if($winner == "y"){
                            $message->setSubject('Meta Theme Color: Yellow Won!');
                            $message->setTextBody('Defeat! Please check https://meta-theme-color.appspot.com/stats for more details.');
                        }
                        $message->send();
                    } catch (InvalidArgumentException $e) {
                        exit($e->getMessage());
                    }
                } 
            }
        }
        else{
            // Nobody won
            $select = $db->prepare('SELECT email FROM mtc.users WHERE today_color IS NOT NULL');
            $select->execute();
            $result = $select->fetchAll();
            $count = count($result);
            for ($x = 0; $x < $count; $x++) {
                try {
                    $message = new Message();
                    $message->setSender('no-reply@meta-theme-color.appspotmail.com');
                    $message->addTo($result[$x][0]);
                    $message->setSubject('Meta Theme Color: Nobody Won!');
                    $message->setTextBody('Better luck next time. Please check https://meta-theme-color.appspot.com/stats for more details.');
                    $message->send();
                } catch (InvalidArgumentException $e) {
                    exit($e->getMessage());
                }
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