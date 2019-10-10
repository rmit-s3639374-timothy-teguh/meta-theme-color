<?php
    function colors($color){
        // Echoes out a colored text with the name of the color
        switch($color){
            case 'r':
                echo(
                    '<span class="red_s">
                        Red
                    </span>'
                );
                break;
            case 'g':
                echo(
                    '<span class="green_s">
                        Green
                    </span>'
                );
                break;
            case 'b':
                echo(
                    '<span class="blue_s">
                        Blue
                    </span>'
                );
                break;
            case 'c':
                echo(
                    '<span class="cyan_s">
                        Cyan
                    </span>'
                );
                break;
            case 'm':
                echo(
                    '<span class="magenta_s">
                        Magenta
                    </span>'
                );
                break;
            case 'y':
                echo(
                    '<span class="yellow_s">
                        Yellow
                    </span>'
                );
                break;
            default:
                echo('None');
        }
    }

    function user_init($email){
        // Attempts to add user to database, if an entry does not exist
        try{
            $db = null;
            $db = new pdo('mysql:unix_socket=/cloudsql/meta-theme-color:australia-southeast1:mtc-database;dbname=mtc', 'root', '');
            // Search if user already exists in the database
            $select = $db->prepare('SELECT * FROM mtc.users WHERE email = ?');
            $select->execute(array($email));
            $result = $select->fetchAll();
            if(empty($result)){
                // Add user to database
                $insert = $db->prepare('INSERT INTO mtc.users (email, points, today_color, yesterday_color) VALUES (?, 0, null, null)');
                $insert->execute(array($email));
            }
    
            $db = null;
    
        }catch(PDOException $ex){
            exit($ex->getMessage());
        }
    }
?>