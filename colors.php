<html>
<head>
  <title>Meta Theme Color</title>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href='/css/colors.css'>
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

<h3>Choose a Color</h3>
<p>You cannot change your choice once you pick. Choose wisely.</p>

<div id="red" class="red">
    <span class="text">
    <a href="red">Red</a>
</div>
<div class="green">
    <span class="text">
    <a href="green">Green</a>
</div>
<div class="blue">
    <span class="text">
    <a href="blue">Blue</a>
</div>
<div class="cyan">
    <span class="text">
    <a href="cyan">Cyan</a>
</div>
<div class="magenta">
    <span class="text">
    <a href="magenta">Magenta</a>
</div>
<div class="yellow">
    <span class="text">
    <a href="yellow">Yellow</a>
</div>
</html>