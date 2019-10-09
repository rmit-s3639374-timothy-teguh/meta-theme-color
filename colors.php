<html>
<head>
  <title>Meta Theme Color</title>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href='/css/default.css'>
</head>
<?php
	use google\appengine\api\users\UserService;
	
	$user = UserService::getCurrentUser();

    if (isset($user)) {
		$logout_url = UserService::createLogoutUrl('/');
		echo('<p><i>You are currently logged in as '.$user->getEmail().'</i></p>');
        echo('<p><a href="'.$logout_url.'">Logout</a></p>');
	} else {
        header('Location: main');
    }
?>
<p><a href="stats">View Statistics</a></p>
<p><a href="main">Back to Main Page</a></p>

<h2>Choose a Color</h2>
<p>You cannot change your choice once you choose. Choose wisely.</p>
<p>To earn points, you need to choose the least chosen color.</p>

<div class="red">
    <span class="text">
    <p><a href="red">Red</a></p>
</div>
<div class="green">
    <span class="text">
    <p><a href="green">Green</a></p>
</div>
<div class="blue">
    <span class="text">
    <p><a href="blue">Blue</a></p>
</div>
<div class="cyan">
    <span class="text">
    <p><a href="cyan">Cyan</a></p>
</div>
<div class="magenta">
    <span class="text">
    <p><a href="magenta">Magenta</a></p>
</div>
<div class="yellow">
    <span class="text">
    <p><a href="yellow">Yellow</a></p>
</div>
</html>