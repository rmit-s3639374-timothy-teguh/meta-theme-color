<html>
<head>
  <title>Meta Theme Color</title>
  <meta charset='UTF-8'>
</head>

<body>
<h1>Welcome to Meta Theme Color!</h1>
<p>A strange game where you take a few seconds to pick a color for the day and wait for the results.</p>

<?php
	use google\appengine\api\users\UserService;
	
	$user = UserService::getCurrentUser();

	if (isset($user)) {
		echo('Welcome, '.$user->getNickname().'! (<a href="'.UserService::createLogoutUrl('/').'">sign out</a>)');
	} else {
		echo('<a href="'.UserService::createLoginUrl('/').'">Sign in or register</a>');
	}
?>

</body>