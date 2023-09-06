<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipeName = $_POST['recipeName'];
    $ingredients = $_POST['ingredients'];
    $preparationTime = $_POST['preparationTime'];
    $difficultyLevel = $_POST['difficultyLevel'];

    $sql = "INSERT INTO demo (recipe_name, ingredients, preparation_time, difficulty_level) VALUES ('$recipeName', '$ingredients', '$preparationTime', '$difficultyLevel')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No data submitted.";
}

$conn->close();
