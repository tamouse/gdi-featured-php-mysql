<?php
error_reporting(-1); // report everything possible



/** FUNCTIONS **/

// Create a function to prepare each piece of data for output
function escape_html($html)
{
  return htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
}



/** INTIALIZATION **/

$page_title = "Product Listing";

// Define the SQL to retrieve all the products
$sql='SELECT productID , company, type, roast, description FROM product ORDER BY productID DESC';
error_log("SQL to retrieve products: $sql");





/** FETCHING DATA **/


// Initialize the connection to the database
require_once 'db.inc.php';

// Run the query
$result = mysqli_query($link, $sql);
if (! $result) report_error_and_die("Could not retrieve the data from the product table", mysqli_error($linke));


// We now use the $result returns to obtain all the data rows and save them for later display
$data = [];
while($record = mysqli_fetch_assoc($result)) {
  $row = [];
  foreach(['productID', 'company', 'type', 'roast', 'description'] as $column) {
    $row[$column] = escape_html($record[$column]);
  }
  $data[] = $row;
}





/** DISPLAY **/

include_once 'page_header.php';

// Display the data fetched above as a table
echo '<table><tr>';

foreach (array_keys($data[0]) as $column) {
  echo '<th>' . $column . '</th>';
}
echo '</tr>' . PHP_EOL;

foreach($data as $row) {
  echo '<tr>';
  foreach($row as $column => $value) {
    echo '<td>' . $value . '</td>';
  }
  echo '</tr>' . PHP_EOL;
}
echo '</table>' . PHP_EOL;


echo '<p>Return to <a href="index.php">entry form</a>.</p>';

include_once 'page_footer.php';
