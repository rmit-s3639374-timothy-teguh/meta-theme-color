<?php
    include 'functions.php'; 
    user_checks();
    time_check();
    include 'header.php';
    include 'menu.php';
    include 'clock.php';

    use google\appengine\api\users\UserService;
	$user = UserService::getCurrentUser();
    try{
        $db = null;
        $db = new pdo('mysql:unix_socket=/cloudsql/meta-theme-color:australia-southeast1:mtc-database;dbname=mtc', 'root', '');

        $select = $db->prepare('SELECT today FROM mtc.entries WHERE color = "b"');
        $select->execute();
        $result = $select->fetchAll();
        $today = $result[0][0];

        $update = $db->prepare('UPDATE mtc.entries SET today = ? WHERE color = "b"');
        $update->execute(array($today + 1));

        $update = $db->prepare('UPDATE mtc.users SET today_color = "b" WHERE email = ?');
        $update->execute(array($user->getEmail()));

    }catch(PDOException $ex){
        exit($ex->getMessage());
    }
?>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <h2>You Have Chosen <?php colors('b');?></h2>
    <p>Below are the current counts for each of the colors. It will be useful for you and your friends.</p>
    <p>This information is only displayed once! It will dissapear as soon as you leave or refresh the page. Make sure to screenshot and save this somewhere!</p>
    <h3>Today's Results</h3>
    <?php
        try{
            $select = $db->prepare('SELECT color, today FROM mtc.entries ORDER BY color');
            $select->execute();
            $result = $select->fetchAll();
            $db = null;
        }catch(PDOException $ex){
            exit();
        }
        $b_num = $result[0][1];
        $c_num = $result[1][1];
        $g_num = $result[2][1];
        $m_num = $result[3][1];
        $r_num = $result[4][1];
        $y_num = $result[5][1];
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
        title: 'Today\'s Results',
        colors: ['#ee0000', '#00ee00', '#0000ee', '#00eeee', '#ee00ee', '#eeee00']
        };
    // Instantiate and draw the chart.
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
    }
</script>
</html>