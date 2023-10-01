<?php
require_once "includes/connect.php";

$results = [];
$insertedRows = 0;

try {
    if (!isset($_REQUEST["recipe_name"]) || !isset($_REQUEST["ingredients"]) || !isset($_REQUEST["preparation_time"]) || !isset($_REQUEST["difficulty_level"])) {
        throw new Exception('Required data is missing, i.e., recipe_name, ingredients, preparation_time, difficulty_level');
    }

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
        } else {
            throw new Exception("No rows were inserted");
        }

        echo json_encode($results);
    } else {
        throw new Exception("Prepared statement did not insert records.");
    }
} catch (Exception $error) {
    echo json_encode(["error" => $error->getMessage()]);
} finally {
    echo json_encode([
        "message" => $_REQUEST["recipe_name"],
        "ingredients" => $_REQUEST["ingredients"],
        "preparation_time" => $_REQUEST["preparation_time"],
        "difficulty_level" => $_REQUEST["difficulty_level"],
    ]);
}
