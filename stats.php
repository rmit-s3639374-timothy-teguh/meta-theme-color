<html>
<?php
    include 'header.php'; 
?>
<h2>Statistics</h2>
<?php
    $points = 0;
    // Put function for getting points here
    echo('<p>Total Points: '.$points.'</p>');
    $color = null;
    // Put function for getting chosen color here
    switch($color){
        case 'r':
            echo(
                '<div class="red">
                    <span class="text">
                    <p><a href="red">Red</a></p>
                </div>'
            );
            break;
        case 'g':
            echo(
                '<div class="green">
                    <span class="text">
                    <p><a href="green">Green</a></p>
                </div>'
            );
            break;
        case 'b':
            echo(
                '<div class="blue">
                    <span class="text">
                    <p><a href="blue">Blue</a></p>
                </div>'
            );
            break;
        case 'c':
            echo(
                '<div class="cyan">
                    <span class="text">
                    <p><a href="cyan">Cyan</a></p>
                </div>'
            );
            break;
        case 'm':
            echo(
                '<div class="magenta">
                    <span class="text">
                    <p><a href="magenta">Magenta</a></p>
                </div>'
            );
            break;
        case 'y':
            echo(
                '<div class="yellow">
                    <span class="text">
                    <p><a href="yellow">Yellow</a></p>
                </div>'
            );
            break;
        default:
            echo('<p>Today\'s Color: None</p>');
    }
?>