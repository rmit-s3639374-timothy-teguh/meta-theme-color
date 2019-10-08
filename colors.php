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
        echo('<p>You are currently logged in as '.$user->getEmail().'</p>');
        echo('<p><a href="'.$logout_url.'">Logout</a></p>');
	} else {
        header('Location: main');
    }
?>
<p><a href="main">Back to Main Page</a></p>
<h3>Choose a Color</h3>
<p>You cannot change your choice once you pick. Choose wisely.</p>

<div id="red" class="div">
    <span class="text">
    <a href="red">Red</a>
</div>
</html>