<?php

// This connects the script to the database
include 'db.inc.php';



// $company = mysqli_real_escape_string($link, $_GET['company']);
// $type = mysqli_real_escape_string($link, $_GET['type']);
// $roast = mysqli_real_escape_string($link, $_GET['roast']);
// $description = mysqli_real_escape_string($link, $_GET['description']);


// The above can be reduced via programming to the following:
$data=[]; // initialize to an empty array, we'll be filling it in a second

// loop through the fields
foreach(['company', 'type', 'roast', 'description'] as $field) {
  // checks whether the field is present, if so, runs the data through a cleaner.
  $data[$field] = isset($_GET[$field]) ? mysqli_real_escape_string($link, $_GET[$field]) : null;
}


// Build the SQL statement. This is a "heredoc". It works just like a
// double-quoted string, except it can also extend over multiple
// lines. Variable interpolation occurs within the "heredoc"
$sql = <<< SQL
INSERT INTO product SET
	company='${data["company"]}',
	type='${data["type"]}',
	roast='${data["roast"]}',
	description='${data["description"]}';
SQL;
error_log('SQL for new product: ' . $sql);





// Insert the data
if (!mysqli_query($link, $sql)) report_error_and_die('Error adding submitted data', mysqli_error($link));


// Redirect to the listing page
header('Location:product_list.php');


// THe `header` function does not halt execution of the script, so we
// do that here:
exit();


// Once again, no closing PHP tag.
