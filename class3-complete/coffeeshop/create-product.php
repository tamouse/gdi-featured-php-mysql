<?php
require_once 'utilities.inc.php';
require_once 'db.inc.php';

$data = [];
foreach (['company', 'type', 'roast', 'description'] as $item) {
    if (isset($_GET[$item])) {
        $data[$item] = escape_string($link, $_GET[$item]);
    }
}

$sql = "INSERT INTO product SET	
    companyID_fk=" . $data['company'] . ",
	type='" . $data['type'] . "',
	roast='" . $data['roast'] . "',
	description='" . $data['description'] . "';";

if (!mysqli_query($link, $sql)) {
    print_error_and_exit($link, 'Error adding submitted data: ' . mysqli_error($link));
}

header('Location:view-products.php');
