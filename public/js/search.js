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

function loadMeals(meals) {
    meals.forEach(meal => {
        console.log(meal);
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
    const description = clone.querySelector("p");
    description.innerHTML = meal.ingredients;
    const like = clone.querySelector(".fa-heart");
    like.innerText = meal.like;
    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = meal.dislike;

    mealContainer.appendChild(clone);
}