<?php
    include 'user.php'; 
    include 'header.php'; 
    include 'menu.php';
?>
<html>
<h2>Statistics</h2>
<?php
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
    $winner = null;
    echo('Yesterday\'s Winner: ');
    colors($winner);
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