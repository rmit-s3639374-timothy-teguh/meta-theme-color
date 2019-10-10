<?php
	use google\appengine\api\users\UserService;
	
	$user = UserService::getCurrentUser();

    if (isset($user)) {
		$logout_url = UserService::createLogoutUrl('/');
		echo('<p><i>You are currently logged in as '.$user->getEmail().'</i></p>');
        echo('<p><a href="'.$logout_url.'">Logout</a></p>');
	} else {
        header('Location: main');
        exit();
    }
?>