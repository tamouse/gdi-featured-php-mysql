<?php
require_once 'utilities.inc.php';

if (! isset($_GET['productID'])) {
    print_error_and_exit("Product ID was not set");
}

require_once 'db.inc.php';

$data = [];

foreach (['productID', 'company', 'type', 'roast', 'description'] as $item) {
    if (isset($_GET[$item])) {
        $data[$item] = escape_string($link, $_GET[$item]);
    } else {
        $data[$item] = null;
    }
}


//SQL statement
$sql = "UPDATE product SET	
    companyID_fk=" . $data['company'] . ",
	type='" . $data['type'] . "',
	roast='" . $data['roast'] . "',
	description='" . $data['description'] . "'
    WHERE productID=" . $data['productID'] . ";";

if (!mysqli_query($link, $sql)) {
    print_error_and_exit('Error adding submitted data: ' . mysqli_error($link));
}

header('Location: view-products.php');
