<?php
	use google\appengine\api\users\UserService;
	
	$user = UserService::getCurrentUser();
?>

<html>
<head>
  <title>Meta Theme Color</title>
  <meta charset='UTF-8'>
  <link rel='stylesheet' type='text/css' href='/css/main.css'>
</head>

<body>
<h1>Welcome to Meta Theme Color!</h1>
<p>Where you play a strange game in which you take a few seconds to pick a color for the day, and wait for the results.</p>

<h3>Why the name?</h3>
<p>The name is a reference to a meta tag. Since this game is rather "meta" and it has something to do with colors, I chose to use that name.</p>

<h3>What even is this website?</h3>
<p>Truth to be told, I do not know what its real purpose is. Basically, it is just a simple game.</p>

<h3>Okay, so how do I play?</h3>
<p>First, you need to be logged in with a Google account. The italicised text below should tell you if you are logged in or not.</p>
<?php
	if (isset($user)) {
		$logout_url = UserService::createLogoutUrl('/');
		echo('<p><i>You are currently logged in as '.$user->getEmail().'</i></p>');
		echo('<p><a href="'.$logout_url.'">Logout</a></p>');
	} else {
		$login_url = UserService::createLoginUrl('/');
		echo('<p><i>You are currently not logged in to any account</i></p>');
		echo('<p><a href="'.$login_url.'">Login</a></p>');
	}
?>
<p>If you are logged in, there should be buttons below.</p>
<?php
	if (isset($user)) {
		echo('<form action="/colors">
			<input type="submit" value="Choose a Color Now!" />
			</form>'
			);
		echo('<form action="/stats">
			<input type="submit" value="Check Your Stats" />
			</form>'
			);
	}
?>
<p>You probably want to continue reading, however.<p>

<h3>Rules of the Game</h3>
<ul>
  <li>You can only choose one color per day.</li>
  <li>The day resets at 12:00 AM (Midnight) Australian Eastern Standard Time.</li>
  <li>If that color is the least picked out of all the other colors, you earn a point.</li>
  <li>The results will be released when the day resets<li>
</ul> 
<p>That's it. Simple, right?<p>

<h3>Purpose of this Website<h3>
<p>It's just for fun. I wanted to make something similar to Reddit's "The Button", because I thought it was an interesting idea. Perhaps this website may be useful for sociology or psychology.<p>

<h3>Why does this website look terrible? It's like it was made in the 80s!<h3>
<p> I wanted a design that was easy on the eyes. Not too flashy in a way that distracts the essence of the game. Truth to be told, I like the simplicity of the default styling.<p>
</body>
<html>