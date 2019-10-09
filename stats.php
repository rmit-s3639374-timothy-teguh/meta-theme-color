<html>
<?php
    include 'header.php'; 
?>
<h2>Statistics</h2>
<?php
    $points = 0;
    // Put function for getting points here
    echo('<p>Points: '.$points.'</p>');
    $color = null;
    // Put function for getting chosen color here
    echo('Color: ');
    switch($color){
        case 'r':
            echo(
                '<div class="red">
                    <span class="text">
                    <a href="red">Red</a>
                </div>'
            );
            break;
        case 'g':
            echo(
                '<div class="green">
                    <span class="text">
                    <a href="green">Green</a>
                </div>'
            );
            break;
        case 'b':
            echo(
                '<div class="blue">
                    <span class="text">
                    <a href="blue">Blue</a>
                </div>'
            );
            break;
        case 'c':
            echo(
                '<div class="cyan">
                    <span class="text">
                    <a href="cyan">Cyan</a>
                </div>'
            );
            break;
        case 'm':
            echo(
                '<div class="magenta">
                    <span class="text">
                    <a href="magenta">Magenta</a>
                </div>'
            );
            break;
        case 'y':
            echo(
                '<div class="yellow">
                    <span class="text">
                    <a href="yellow">Yellow</a>
                </div>'
            );
            break;
        default:
            echo('None');
    }
?>
<h3>Yesterday's Results</h3>
</html>