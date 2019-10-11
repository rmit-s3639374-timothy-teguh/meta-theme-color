<?php
    date_default_timezone_set('Australia/Brisbane');
    $date = date('m/d/Y H:i:s', time());
    echo('<p><b>Current Time: '.$date.' AEST</b></p>');
?>