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
<p><a href="colors">Choose a Color</a></p>
<p><a href="stats">View Statistics</a></p>
<p><a href="main">Back to Main Page</a></p>