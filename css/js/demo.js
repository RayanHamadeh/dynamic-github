document.addEventListener('DOMContentLoaded', function () {
    
    document.getElementById('recipeForm').addEventListener('submit', function (event) {
        event.preventDefault(); 

        const formData = new FormData(this);

        
        fetch('insert.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            
            if (!data.error) {
                
                appendRecord(data);
            } else {
                console.error('Insert error:', data.error);
            }
        })
        .catch(error => {
            console.error('Insert error:', error);
        });

        
        fetchData();
    });

    
    function fetchData() {
        fetch('select.php')
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('insertedData');

                if (data.error) {
                    console.error(data.error);
                } else {
                    list.innerHTML = ''; 
                    data.forEach(record => {
                        appendRecord(record);
                    });
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    }

    fetchData(); 

    
    function appendRecord(record) {
        const list = document.getElementById('insertedData');
        const listItem = document.createElement('li');
        listItem.textContent = `Recipe Name: ${record.recipe_name}, Ingredients: ${record.ingredients}, Preparation Time: ${record.preparation_time}, Difficulty Level: ${record.difficulty_level}`;
        list.appendChild(listItem);
    }
});
