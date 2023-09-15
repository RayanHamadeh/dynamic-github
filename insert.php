<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipeName = $_POST['recipeName'];
    $ingredients = $_POST['ingredients'];
    $preparationTime = $_POST['preparationTime'];
    $difficultyLevel = $_POST['difficultyLevel'];

    $sql = "INSERT INTO demo (recipe_name, ingredients, preparation_time, difficulty_level) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $recipeName, $ingredients, $preparationTime, $difficultyLevel);

    if ($stmt->execute()) {
        $lastInsertedId = $stmt->insert_id;
        $result = $conn->query("SELECT * FROM demo WHERE id = $lastInsertedId");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Data not found.']);
        }
    } else {
        echo json_encode(['error' => $stmt->error]);
    }
} else {
    echo json_encode(['error' => 'No data submitted.']);
}

$stmt->close();
$conn->close();
