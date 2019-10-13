<?php
    use google\appengine\api\users\UserService;

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
    
    function has_chosen($email){
        // Checks if user has already chosen a color today
        try{
            $db = null;
            $db = new pdo('mysql:unix_socket=/cloudsql/meta-theme-color:australia-southeast1:mtc-database;dbname=mtc', 'root', '');
            // Search if user already exists in the database
            $select = $db->prepare('SELECT today_color FROM mtc.users WHERE email = ?');
            $select->execute(array($email));
            $result = $select->fetchAll();
            $chosen_color = $result[0][0];
            $db = null;
            if($chosen_color != null){
                return true;
            }
            else{
                return false;
            }
        }catch(PDOException $ex){
            exit($ex->getMessage());
        }
    }

    // Run checks to redirect the user if certain conditions are not met
    function user_checks(){
        $user = UserService::getCurrentUser();
        if (isset($user)) {
            user_init($user->getEmail());
            if(has_chosen($user->getEmail()) == true){
                header('Location: wait');
                exit();
            }
            $logout_url = UserService::createLogoutUrl('/');
            echo('<p><i>You are currently logged in as '.$user->getEmail().'</i></p>');
            echo('<p><a href="'.$logout_url.'">Logout</a></p>');
        } else {
            header('Location: main');
            exit();
        }
    }
    function user_checks_basic(){
        // Variant, while ignoring whether or not the user has chosen a color
        $user = UserService::getCurrentUser();
        if (isset($user)) {
            user_init($user->getEmail());
            $logout_url = UserService::createLogoutUrl('/');
            echo('<p><i>You are currently logged in as '.$user->getEmail().'</i></p>');
            echo('<p><a href="'.$logout_url.'">Logout</a></p>');
        } else {
            header('Location: main');
            exit();
        }
    }

    function user_checks_chose(){
        // Variant that checks that if user has not chosen yet
        $user = UserService::getCurrentUser();
        if (isset($user)) {
            user_init($user->getEmail());
            if(has_chosen($user->getEmail()) == false){
                header('Location: colors');
                exit();
            }
            $logout_url = UserService::createLogoutUrl('/');
            echo('<p><i>You are currently logged in as '.$user->getEmail().'</i></p>');
            echo('<p><a href="'.$logout_url.'">Logout</a></p>');
        } else {
            header('Location: main');
            exit();
        }
    }

    function time_check(){
        // Checks time and redirects user if overtime
        date_default_timezone_set('Australia/Brisbane');
        $hour = date('H', time());
        $hour = intval($hour);
        if($hour < 2){
            header('Location: timeout');
            exit();
        }
    }

    function time_check_reverse(){
        // Same idea, but this time for timeout.php, and redirect to main
        date_default_timezone_set('Australia/Brisbane');
        $hour = date('H', time());
        $hour = intval($hour);
        if($hour >= 2){
            header('Location: main');
            exit();
        }
    }
?>