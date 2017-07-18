<?php
// files which are only intended to be included or required in other scripts have ".inc" in the file name by convention

require_once 'utilities.inc.php';

/**
 * Gathering the Data
 */

//Connect to the DB
require_once 'db.inc.php';

//Select the company IDs from the database
$sql = 'SELECT companyID, name FROM company ORDER BY name';
$result = mysqli_query($link, $sql);
if (!$result) {
    print_error_and_exit($link, 'Unable to select company information' . mysqli_error($link));
}

// Collect the results from the select
while ($row = mysqli_fetch_assoc($result)) {
    $options[clean_string($row['name'])] = clean_string($row['companyID']);
}


/**
 * Prepare the output
 */
?>
Company: <select name="company">
    <?php foreach ($options as $name => $value) {
        echo "<option value=\"$value\">$name</option>";
    } ?>
</select>