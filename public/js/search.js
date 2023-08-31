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
    author.innerText = `author: ${meal.author}`;

    mealContainer.appendChild(clone);
}
