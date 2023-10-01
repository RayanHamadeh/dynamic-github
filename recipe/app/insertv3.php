<?php
require_once "includes/connect.php";

$results = [];
$insertedRows = 0;

// Function to check if a recipe already exists based on recipe_name
function selectRecipe($link)
{
    $query = "SELECT * FROM demo WHERE recipe_name = ?";

    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $_REQUEST["recipe_name"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_num_rows($result) > 0;
    } else {
        throw new Exception("No recipe was found");
    }
}

// Function to update recipe data
function updateRecipeData($link)
{
    $query = "UPDATE demo SET ingredients = ?, preparation_time = ?, difficulty_level = ? WHERE recipe_name = ?";

    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ssss", $_REQUEST["ingredients"], $_REQUEST["preparation_time"], $_REQUEST["difficulty_level"], $_REQUEST["recipe_name"]);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) <= 0) {
            throw new Exception("Error updating recipe data: " . mysqli_stmt_error($stmt));
        }
        return mysqli_stmt_affected_rows($stmt);
    }
}

// Function to insert new recipe data
function insertRecipeData($link)
{
    $query = "INSERT INTO demo (recipe_name, ingredients, preparation_time, difficulty_level) VALUES (?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "ssss", $_REQUEST["recipe_name"], $_REQUEST["ingredients"], $_REQUEST["preparation_time"], $_REQUEST["difficulty_level"]);
        mysqli_stmt_execute($stmt);
        $insertedRows = mysqli_stmt_affected_rows($stmt);

        if ($insertedRows > 0) {
            return $insertedRows;
        } else {
            throw new Exception("No rows were inserted");
        }
    }
}

try {
    // Check if required recipe data is provided
    if (!isset($_REQUEST["recipe_name"]) || !isset($_REQUEST["ingredients"]) || !isset($_REQUEST["preparation_time"]) || !isset($_REQUEST["difficulty_level"])) {
        throw new Exception('Required data is missing, i.e., recipe_name, ingredients, preparation_time, difficulty_level');
    } else {
        // If recipe exists, update it; otherwise, insert it
        if (selectRecipe($link)) {
            $updatedRows = updateRecipeData($link);
            $results[] = ["updateRecipeData() affected_rows" => $updatedRows];
        } else {
            $insertedRows = insertRecipeData($link);
            $results[] = ["insertRecipeData() affected_rows" => $insertedRows];
        }
    }
} catch (Exception $error) {
    $results[] = ["error" => $error->getMessage()];
} finally {
    // Echo out results
    echo json_encode($results);
}
