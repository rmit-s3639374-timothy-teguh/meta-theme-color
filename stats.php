<html>
<?php
    include 'header.php'; 
?>
<h2>Statistics</h2>
<?php
    function colors($color){
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
    $points = 0;
    // Put function for getting points here
    echo('<p>Points: '.$points.'</p>');
    $chosen_color = null;
    // Put function for getting chosen color here
    echo('Today\'s Color: ');
    colors($chosen_color);
    
?>
<h3>Yesterday's Results</h3>
<?php
    $yesterday_color = null;
    echo('You Chose: ');
    colors($yesterday_color);
    $r_num = 0;
    $g_num = 0;
    $b_num = 0;
    $c_num = 0;
    $m_num = 0;
    $y_num = 0;
    echo(
        '<div class="red">
            <span class="text">
            <p>Red = '.$r_num.'</p>
        </div>'
    );
    echo(
        '<div class="green">
            <span class="text">
            <p>Green = '.$g_num.'</p>
        </div>'
    );
    echo(
        '<div class="blue">
            <span class="text">
            <p>Blue = '.$b_num.'</p>
        </div>'
    );
    echo(
        '<div class="cyan">
            <span class="text">
            <p>Cyan = '.$c_num.'</p>
        </div>'
    );
    echo(
        '<div class="magenta">
            <span class="text">
            <p>Magenta = '.$m_num.'</p>
        </div>'
    );
    echo(
        '<div class="yellow">
            <span class="text">
            <p>Yellow = '.$y_num.'</p>
        </div>'
    );
?>
</html>