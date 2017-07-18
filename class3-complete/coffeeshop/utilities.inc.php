<?php

// Utilities -- these are functions used by many pages. Require this file once at the top of your page.


/**
 * clean_string - a function that prepares a string from the database for safe output to the browser.
 * @param $str - the raw input
 * @return string - the clean string
 */
function clean_string($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * escape_string - prepares a string for entry into the database
 * @param $link - the database link
 * @param $str - the raw input data
 * @return string - the escaped data
 */
function escape_string($link, $str) {
    return mysqli_escape_string($link, $str);
}


/**
 * print_error_and_exit -- pretty much exactly what it does, you can call this
 * after checking the return of a database operation.
 * @param $dblink - the database connection
 */
function print_error_and_exit($msg="Error Occurred") {
    error_log($msg);
    echo $msg;
    exit();
}