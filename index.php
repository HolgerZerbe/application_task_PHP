<?php

require_once 'inc/functions.inc.php';
session_start();

if ($_POST) {

    $allData = clear($_POST["data"]);
    $tableData = seperateData($allData);
};

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Kyto application task PHP</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>

          <form class= "general_form" action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
              <textarea name="data" id="data" cols="100" rows="10" required="required"></textarea>
              <input class="general_form_button" type="submit" value="Create table with data" />
          </form>

          <hr>
                <?php {isset($tableData) ? require 'inc/table.tpl.php': null; } ?>



</body>

</html>