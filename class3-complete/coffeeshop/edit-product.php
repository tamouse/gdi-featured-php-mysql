<?php
require_once 'utilities.inc.php';

if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];
} else {
    print_error_and_exit("Product ID was not set");
}


//Connect to the DB
require_once 'db.inc.php';

//Fetch some data to pre-load the form
$sql = "SELECT companyID_fk, type, roast, description 
        FROM  product 
        WHERE productID='$productID'";
$result = mysqli_query($link, $sql);
if (!$result) {
    print_error_and_exit("Unable to fetch product data for $productID : " . mysqli_error($link));
}

$record = mysqli_fetch_assoc($result);

//Name the variables and save them to use later
$companyID_fk = $record['companyID_fk'];
$type = clean_string($record['type']);
$roast = clean_string($record['roast']);
$description = clean_string($record['description']);


include 'header.php';
?>
    <form action="update-product.php" method="get">
        <?php include 'select_company.inc.php'; ?>
        <br>
        Type: <input type="text" name="type" value="<?php echo $type //Sets current value as default?>"/><br/>
        Roast:
        <label><input type="radio" name="roast" value="light"
                <?php if ($roast == "light") echo "checked='checked'" //Sets current value as default if appropriate?>>Light</label>
        <label><input type="radio" name="roast" value="medium"
                <?php echo $roast == 'medium' ? "checked='checked'" : '' //Another way to do it ?>>Medium</label>
        <label><input type="radio" name="roast" value="dark"
                <?php if ($roast == "dark") echo "checked='checked'" ?>>Dark</label>
        <br>
        <textarea name="description" rows="10" cols="40"><?php echo $description //Sets current value as default?></textarea><br/>
        <input type="hidden" name="productID" value="<?php echo $productID //Hidden field to make the form work better?>">
        <input type="submit" value="Submit">
    </form>

<?php
include 'sidebar.php';
include 'footer.php';
?>