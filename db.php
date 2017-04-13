<?php

//require_once '/var/www/localhost/htdocs/conf/helper.inc';
require_once '../_lib/helper.inc';
$conn = helper_login('gp');
if (!$conn) {
    die("Database Connection FAILED !!!");
}

?>