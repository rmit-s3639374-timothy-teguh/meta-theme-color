<?php
    include 'user.php'; 
    include 'header.php';
    include 'menu.php';
    include 'clock.php';
?>
<html>
<h2>Statistics</h2>
<?php
    $points = 0;
    // Put function for getting points here
    echo('<p>Points: '.$points.'</p>');
    $chosen_color = null;
    // Put function for getting chosen color here
    echo('<p>Today\'s Color: <b>');
    colors($chosen_color);
    echo('</b></p>');
?>
<h3>Yesterday's Results</h3>
<?php
    $yesterday_color = null;
    echo('<p>You Chose: <b>');
    colors($yesterday_color);
    echo('</b></p>');
    $winner = null;
    echo('<p>Winner: <b>');
    colors($winner);
    echo('</b></p>');
    $r_num = 0;
    $g_num = 0;
    $b_num = 0;
    $c_num = 0;
    $m_num = 0;
    $y_num = 0;
    echo(
        '<div class="red">
            <span class="text">
            <p><b>Red = '.$r_num.'</b></p>
        </div>'
    );
    echo(
        '<div class="green">
            <span class="text">
            <p><b>Green = '.$g_num.'</b></p>
        </div>'
    );
    echo(
        '<div class="blue">
            <span class="text">
            <p><b>Blue = '.$b_num.'</b></p>
        </div>'
    );
    echo(
        '<div class="cyan">
            <span class="text">
            <p><b>Cyan = '.$c_num.'</b></p>
        </div>'
    );
    echo(
        '<div class="magenta">
            <span class="text">
            <p><b>Magenta = '.$m_num.'</b></p>
        </div>'
    );
    echo(
        '<div class="yellow">
            <span class="text">
            <p><b>Yellow = '.$y_num.'</b></p>
        </div>'
    );
?>
</html>