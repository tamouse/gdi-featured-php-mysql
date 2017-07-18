<?php
// Declare any functions first
require_once 'utilities.inc.php';


// Gather and prepare data


//Connect to DB
require_once 'db.inc.php';

//This is a new syntax. Because we are selecting data from two tables, we need to specify which one by using tablename.fieldname
$sql = 'SELECT 
        product.productID as productID, 		
        product.type as type, 
        product.roast as roast, 
        product.companyID_fk as companyID_fk,
        product.description as description, 
        company.companyID as companyID,
        company.name as  name
        FROM product, company
        where product.companyID_fk=company.companyID;
';
$result = mysqli_query($link, $sql);
if (!$result) {
    print_error_and_exit('Unable to select product information: ' . mysqli_error($link));
}

$table = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tableRow = [];
    foreach ($row as $column => $data) {
        $tableRow[$column] = clean_string($data);
    }
    $table[] = $tableRow;
}



// Output
include_once 'header.php';
?>
    <p>We have a variety of delicious coffees in stock.</p>
    <table>
        <thead>
        <tr>
            <th>Company</th>
            <th>Type</th>
            <th>Roast</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($table as $tableRow) {
            echo '<tr>';
            echo "<td>${tableRow['name']}</td>";
            echo "<td>${tableRow['type']}</td>";
            echo "<td>${tableRow['roast']}</td>";
            echo "<td>${tableRow['description']}</td>";
            echo '<td><a href="edit-product.php?productID=' . $tableRow['productID'] . '">Edit</a></td>';
            echo '<td><a href="delete-product.php?productID=' . $tableRow['productID'] . '">Delete</a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    <p>Return to <a href="index.php">home</a>.</p>
<?php
include_once 'sidebar.php';
include_once 'footer.php';
?>

