<?php
require_once "includes/connect.php";

$results = [];

$query = "SELECT `User ID`, recipe_name, ingredients, preparation_time, difficulty_level FROM demo";

if ($stmt = mysqli_prepare($link, $query)) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $results[] = $row;
    }

    echo json_encode($results);
}

mysqli_close($link);
