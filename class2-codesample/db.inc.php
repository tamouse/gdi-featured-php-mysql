<?php

// Modify the following variables to match the database credentials
// on your system. It's okay to save these in the file in *this* case
// since this is just a sample. HOWEVER, you should never store real,
// accessible credentials of any kind in a public or private
// repository.

$db_name = 'coffee';
$db_user = 'root';
$db_password = 'root';
$db_host = 'localhost';



// You shouldn't need to edit anything below.


// It is generally good practice to arrange your scripts like this:
// - assign variables to be set for the local environment at the top,
//   so they can be seen first.
// - define the various functions your script will be using.
// - put the operations to be executed at the end.




// Create a function to use for each failure.
// This is D.R.Y.
function report_failure_and_die($msg, $error)
{
  $output = $msg . ": " . $error;
  error_log($output);
  echo $output;
  die($output);
}




// Log in to the database.
$link=mysqli_connect ($db_host, $db_user, $db_password);
// ALWAYS check the result of a database operation
if  (!$link) report_failure_and_die('Unable to connect to the database', mysqli_connect_error());


// Setting the Character set used for the the database.
if (!mysqli_set_charset($link,'utf8')) report_failure_and_die('Unable to set database connection encoding', mysqli_error($link));


// Selewcting the database for this application.
// NOTE: the database must already exist
if (!mysqli_select_db($link, $db_name)) report_failure_and_die('Unable to locate the database', mysqli_error($link));




// Leave off the closing tag
