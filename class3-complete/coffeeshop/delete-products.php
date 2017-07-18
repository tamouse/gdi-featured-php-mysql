<?php
require_once 'utilities.inc.php';
require_once 'db.inc.php';

if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];
} else {
    print_error_and_exit('Failed to provide the productID');
}

$sql = "DELETE FROM product WHERE productID='$productID'";
$result = mysqli_query($link, $sql);

if (!$result) {
    print_error_and_exit('Error deleting product: ' . mysqli_error($link));
}

header('Location: view-products.php');
?>