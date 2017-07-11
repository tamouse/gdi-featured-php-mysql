A small sample of getting data from a form and saving it in a
database.

## Files

  `db.inc.php` - a small script that you can include in each PHP
  script that connects to the database. When you include it, your
  script will have a database connection in the variable `$link` .

- `index.html` - this is the main form that is used to gather
  information. This is just a regular HTML file, there's no PHP code
  in it.

- `product_insert_result.php` - this script is called when the form in
  `index.html` is submitted. It takes the form input, scrubs it, and
  inserts it into the database. If the database insertion is
  successful, the script redirects to the `product_list` script to
  list all the products.

- `product_list.php` - retrieve all the products from the database and
  display them in a list.
