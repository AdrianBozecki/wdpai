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

// Oczekuj na załadowanie całej strony
document.addEventListener("DOMContentLoaded", function() {

    // Pobierz wszystkie elementy z klasą 'meal' i dodaj do nich nasłuchiwanie na zdarzenie 'click'
    document.querySelectorAll('.meal').forEach(function(mealElement) {
        mealElement.addEventListener('click', function(event) {

            // Pobranie ID elementu, który został kliknięty
            const clickedElementId = event.currentTarget.id;

            // Pobranie numerycznego ID posiłku z pełnego ID elementu
            const mealId = clickedElementId.split('-')[1];

            // Logowanie ID do konsoli
            console.log('Kliknięto w posiłek z ID:', mealId);

            // Tutaj możesz później umieścić kod, który będzie pobierał szczegóły posiłku
        });
    });

});

// Pobierz modal
var modal = document.getElementById("myModal");

// Pobierz element, który zamyka modal
var span = document.getElementsByClassName("close")[0];

// Kiedy użytkownik kliknie na element (span), zamknij modal
span.onclick = function() {
    modal.style.display = "none";
}

// Kiedy użytkownik kliknie gdziekolwiek poza modalem, zamknij go
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Funkcja do otwarcia modala i wyświetlenia danych
function openModalWithData(data) {
    // Wprowadź dane do modala
    var modalBody = document.getElementById("modal-body");
    modalBody.innerHTML = `
    <p>Tytuł: ${data.title}</p>
    <p>Przygotowanie: ${data.preparation}</p>
    <p>Składniki: ${data.ingredients}</p>
  `;

    // Wyświetl modal
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
        .then(response => response.json())  // Odczytaj surową odpowiedź jako tekst
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

