// Function to fetch and display recipe data
async function fetchRecipes(url) {
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const data = await response.json();
    displayData(data);
  } catch (error) {
    console.error("Error fetching recipe data:", error);
  }
}

// Call function to fetch recipe data
fetchRecipes("app/select.php");

// Function to fetch and display recipe data
async function fetchRecipes(url) {
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const data = await response.json();
    displayData(data);
  } catch (error) {
    console.error("Error fetching recipe data:", error);
  }
}

// Call function to fetch recipe data
fetchRecipes("app/select.php");

// Function to display recipe data
function displayData(data) {
  const display = document.querySelector("#display");
  display.innerHTML = "";

  let ul = document.createElement("ul");

  data.reverse();

  data.forEach((recipe) => {
    let li = document.createElement("li");
    li.innerHTML = `Recipe: ${recipe.recipe_name}, Ingredients: ${recipe.ingredients}, Preparation Time: ${recipe.preparation_time}, Difficulty Level: ${recipe.difficulty_level}`;

    let doneButton = document.createElement("button");
    doneButton.innerText = "Done";
    doneButton.addEventListener("click", () => {
      hideRecipe(li);
    });

    li.appendChild(doneButton);
    ul.appendChild(li);
  });

  display.appendChild(ul);
}

// Function to hide a recipe when marked as done
function hideRecipe(recipeElement) {
  recipeElement.style.display = "none";
}

// Handle form submission for adding a new recipe
const submitButton = document.querySelector("#submit");
submitButton.addEventListener("click", addRecipe);

function addRecipe(event) {
  event.preventDefault();

  // Get form data and call an async function
  const formData = new FormData(document.querySelector("#recipe-form"));
  let url = "app/insert.php";
  inserter(formData, url);
}

// Async function to insert a new recipe
async function inserter(data, url) {
  try {
    const response = await fetch(url, {
      method: "POST",
      body: data,
    });
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const confirmation = await response.json();
    console.log(confirmation);

    // Call function again to refresh the page with updated data
    fetchRecipes("app/select.php");
  } catch (error) {
    console.error("Error inserting recipe:", error);
  }
}
