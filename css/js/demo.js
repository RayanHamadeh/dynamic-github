
document.getElementById("recipeForm").addEventListener("submit", function (event) {
    const recipeName = document.getElementById("recipeName").value;
    const ingredients = document.getElementById("ingredients").value;
    const preparationTime = document.getElementById("preparationTime").value;

    if (recipeName.trim() === "" || ingredients.trim() === "" || preparationTime.trim() === "") {
        alert("Please fill in all required fields.");
        event.preventDefault(); 
    }
});
