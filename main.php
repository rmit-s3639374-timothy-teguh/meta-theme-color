<?php
	use google\appengine\api\users\UserService;
	
	$user = UserService::getCurrentUser();
?>

<html>
<head>
  <title>Meta Theme Color</title>
  <meta charset='UTF-8'>
</head>

<body>
<h1>Welcome to Meta Theme Color!</h1>
<p>Where you play a strange game in which you take a few seconds to pick a color for the day, and wait for the results.</p>

<h3>What even is this website?</h3>
<p>Truth to be told, I do not know what its real purpose is. Basically, it is just a simple game.</p>

<h3>Okay, so how do I play?</h3>
<p>First, you need to be logged in with a Google account. The italicised text below should tell you if you are or not.</p>
<?php
	if (isset($user)) {
		$logout_url = UserService::createLogoutUrl('/');
		echo('<p><i>You are currently logged in as '.$user->getEmail().'</i></p>');
		echo('<a href="'.$logout_url.'">Logout</a>');
	} else {
		$login_url = UserService::createLoginUrl('/');
		echo('<p><i>You are currently not logged in to any account</i></p>');
		echo('<a href="'.$login_url.'">Login</a>');
	}
?>
</body>
<html>