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

          <table class= "general_table">
              <thead>
                <tr>
                    <td>Salutation</td><td>First name</td><td>Last name</td><td>Telephone</td><td>Email</td>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($tableData as $data): ?>
                <?php require 'inc/table.tpl.php'; ?>
            <?php endforeach; ?>
              </tbody>
          </table>

</body>

</html>