<?php

require_once 'utilities.inc.php';

//connect to DB
$link = mysqli_connect('localhost', 'root', 'root');
if (!$link) {
    print_error_and_exit('Unable to connect to the database');
}
if (!mysqli_set_charset($link, 'utf8')) {
    print_error_and_exit('Unable to set database connection encoding: ' . mysqli_error($link));
}
if (!mysqli_select_db($link, 'coffee')) {
    print_error_and_exit('Unable to locate the database: ' . mysqli_error($link));
}
?>