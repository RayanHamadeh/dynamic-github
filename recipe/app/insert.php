<?php
require_once "includes/connect.php";

$results = [];
$insertedRows = 0;

$query = "INSERT INTO demo (recipe_name, ingredients, preparation_time, difficulty_level) VALUES (?, ?, ?, ?)";

if ($stmt = mysqli_prepare($link, $query)) {
    mysqli_stmt_bind_param($stmt, 'ssss', $_REQUEST["recipe_name"], $_REQUEST["ingredients"], $_REQUEST["preparation_time"], $_REQUEST["difficulty_level"]);
    mysqli_stmt_execute($stmt);
    $insertedRows = mysqli_stmt_affected_rows($stmt);

    if ($insertedRows > 0) {
        $results[] = [
            "insertedRows" => $insertedRows,
            "id" => $link->insert_id,
            "recipe_name" => $_REQUEST["recipe_name"]
        ];
    }
    echo json_encode($results);
}
