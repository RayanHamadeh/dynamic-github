<?php
include('connect.php');

$sql = "SELECT * FROM demo";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Recipe Name</th><th>Ingredients</th><th>Preparation Time</th><th>Difficulty Level</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['recipe_name'] . "</td>";
        echo "<td>" . $row['ingredients'] . "</td>";
        echo "<td>" . $row['preparation_time'] . "</td>";
        echo "<td>" . $row['difficulty_level'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

$conn->close();
