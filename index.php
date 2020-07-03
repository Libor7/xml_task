<!DOCTYPE html>
<html lang="sk">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products</title>
    <link href="styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
  </body>
</html>

<?php 

session_start();
require_once('functions.php');

$xml_files = get_xml_files_from_current_dir();
$xml_arr = xml_files_to_array($xml_files);
order_by_price_asc($xml_arr);

!isset($_SESSION['amount']) ? $_SESSION['amount'] = 3 : (isset($_GET['rows']) ? $_SESSION['amount'] = $_GET['rows'] : null);
create_table($xml_arr, $_SESSION['amount']);

?>

<script src="script.js"></script>
