const search = document.querySelector('input[placeholder="search"]');
const mealContainer = document.querySelector(".meals");




search.addEventListener("keyup", function(event) {
   if (event.key === "Enter") {
       event.preventDefault();

       const data = {search: this.value};

       fetch("/search", {
           method: "POST",
           headers: {
               "Content-Type": "application/json"
           },
           body: JSON.stringify(data)
       }).then(function (response) {
           return response.json();
       }).then(function (meals) {
           mealContainer.innerHTML = "";
           meals.sort((a, b) => b.id - a.id);
           loadMeals(meals)
       })
   }

});


document.querySelectorAll('.button').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        const category = this.innerText.toLowerCase();

        fetch(`/getMealsByCategory?category=${category}`,
            {
                method: "GET",
                headers: {
                    "Content-Type": "application/json"
                },
            })
            .then(response => response.json())
            .then(function (meals) {
            meals.sort((a, b) => b.id - a.id);
            mealContainer.innerHTML = "";
            loadMeals(meals)
        })
    });
});

function loadMeals(meals) {
    meals.forEach(meal => {
        createMeal(meal);
    })
}

function createMeal(meal) {
    const template = document.querySelector("#meal-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${meal.image}`

    const title = clone.querySelector("h2");
    title.innerHTML = meal.title;
    const like = clone.querySelector(".fa-heart");
    like.innerText = meal.like;
    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = meal.dislike;
    const author = clone.querySelector(".author");
    console.log(meal)
    author.innerText = `author: ${meal.author}`;

    mealContainer.appendChild(clone);
}

document.addEventListener("DOMContentLoaded", function() {

    document.querySelectorAll('.meal').forEach(function(mealElement) {
        mealElement.addEventListener('click', function(event) {

            const clickedElementId = event.currentTarget.id;

            const mealId = clickedElementId.split('-')[1];

        });
    });

});


var modal = document.getElementById("myModal");


var span = document.getElementsByClassName("close")[0];


span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function openModalWithData(data) {
    var modalBody = document.getElementById("modal-body");
    modalBody.innerHTML = `
    <div style="display: flex;">
        <img src="public/uploads/${data.image}" alt="${data.title}" style="width: 100%; max-width: 400px; margin-right: 20px">
        <div>
            <h2>Meal Details</h2>
            <p>name: ${data.title}</p>
            <p>preparation: ${data.preparation}</p>
            <p>ingredients: ${data.ingredients}</p>
        </div>
    </div>

  `;

    modal.style.display = "block";
}

function fetchMealDetails(mealId) {
    const url = `getMealDetails?id=${mealId}`;

    fetch(url,
        {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            },
        })
        .then(response => response.json())
        .then(data => {
            openModalWithData(data);
        })
        .catch(error => {
            console.error('Wystąpił błąd:', error);
        });
}

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.meal').forEach(function(mealElement) {
        mealElement.addEventListener('click', function(event) {
            const clickedElementId = event.currentTarget.id;
            const mealId = clickedElementId.split('-')[1];

            fetchMealDetails(mealId);
        });
    });
});

