<?php
    include 'user.php'; 
    include 'header.php';
    include 'menu.php';
    include 'clock.php';

	use google\appengine\api\users\UserService;
	$user = UserService::getCurrentUser();
?>

<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <h2>Statistics</h2>
    <?php
        try{
            $db = null;
            $db = new pdo('mysql:unix_socket=/cloudsql/meta-theme-color:australia-southeast1:mtc-database;dbname=mtc', 'root', '');
            // Search if user already exists in the database
            $select1 = $db->prepare('SELECT points, today_color, yesterday_color FROM mtc.users WHERE email = ?');
            $select1->execute(array($user->getEmail()));
            $result1 = $select1->fetchAll();
        }catch(PDOException $ex){
            exit();
        }
        $points = $result1[0][0];
        echo('<p>Points: '.$points.'</p>');
        $chosen_color = $result1[0][1];
        echo('<p>Today\'s Color: <b>');
        colors($chosen_color);
        echo('</b></p>');
    ?>
    <h3>Yesterday's Results</h3>
    <?php
        try{
            $select2 = $db->prepare('SELECT color, yesterday FROM mtc.entries ORDER BY color');
            $select2->execute();
            $result2 = $select2->fetchAll();
            $db = null;
        }catch(PDOException $ex){
            exit();
        }
        $yesterday_color = $result1[0][2];
        echo('<p>You Chose: <b>');
        colors($yesterday_color);
        echo('</b></p>');
        $winner = null;
        echo('<p>Winner: <b>');
        colors($winner);
        echo('</b></p>');
        $b_num = $result2[0][1];
        $c_num = $result2[1][1];
        $g_num = $result2[2][1];
        $m_num = $result2[3][1];
        $r_num = $result2[4][1];
        $y_num = $result2[5][1];
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
    <div id="piechart" style="width: 350px; height: 350px;"></div>
</body>
<script>
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
        ['Color', 'Count'],
        ['Red', <?php echo($r_num); ?>],
        ['Green', <?php echo($g_num); ?>],
        ['Blue', <?php echo($b_num); ?>],
        ['Cyan', <?php echo($c_num); ?>],
        ['Magenta', <?php echo($m_num); ?>],
        ['Yellow', <?php echo($y_num); ?>]
        ]);

        var options = {
        title: 'Yesterday\'s Results',
        colors: ['#ee0000', '#00ee00', '#0000ee', '#00eeee', '#ee00ee', '#eeee00']
        };
    // Instantiate and draw the chart.
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
    }
</script>
</html>