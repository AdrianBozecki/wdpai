<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/meal.css">
    <script src="https://kit.fontawesome.com/8113ee2963.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>Projects</title>
</head>
<body>
<div class="base-container">
    <nav>
        <div class="logo">
            <h1>MEAL<br> FUEL</h1>
        </div>
        <ul>
            <li>
                <i class="fa-solid fa-plate-wheat"></i>
                <a href="/meals" class="button">all</a>
            </li>
        </ul>
    </nav>
    <main>
        <section class="meal-form">
            <h1>Add meal</h1>
            <form action="addMeal" method="POST" ENCTYPE="multipart/form-data">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                <input name="title" type="text" placeholder="title">
                <textarea name="preparation" rows="8" placeholder="preparation"></textarea>
                <textarea name="ingredients" rows="8" placeholder="ingredients"></textarea>
                <input type="file" name="file">
                <div class="dropdown">
                    <select id="category" name="category" onchange="changeCategory()">
                        <option value="all">All</option>
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="soup">Soup</option>
                        <option value="dinner">Dinner</option>
                        <option value="drinks">Drinks</option>
                    </select>
                </div>
                <button class="submit-button" type="submit">submit</button>
            </form>
        </section>
    </main>
</div>

</body>