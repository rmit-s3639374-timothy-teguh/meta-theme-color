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
	use google\appengine\api\users\UserService;
	
	$user = UserService::getCurrentUser();

	if (isset($user)) {
		echo('<p><i>You are currently logged in as '.$user->getNickname().'</i></p>');
		echo('<form action="'.UserService::createLogoutUrl.'">
				<input type="submit" value="Logout" />
			</form>'
			);
	} else {
		echo('<p><i>You are currently not logged in to any account</i></p>');
		echo('<form action="'.UserService::createLoginUrl.'">
				<input type="submit" value="Login" />
			</form>'
			);
	}
?>
</body>
<html>