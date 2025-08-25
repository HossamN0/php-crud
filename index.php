<?php

require_once 'vendor/autoload.php';

use Hossam\ActionsNextJs\Request;
use Hossam\ActionsNextJs\App;

$request = new Request;
$app = new App($request->getQuery());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <form action="http://localhost/actions-next.js/?UserController/insert" method="post">
        <input type="text" name="name">
        <button type="submit">submit</button>
    </form> -->
</body>

</html>