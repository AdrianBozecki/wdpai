<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/meal.css">
    <script src="https://kit.fontawesome.com/8113ee2963.js" crossorigin="anonymous"></script>
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
                <a href="#" class="button">all</a>
            </li>
            <li>
                <i class="fa-solid fa-bacon"></i>
                <a href="#" class="button">breakfast</a>
            </li>
            <li>
                <i class="fa-solid fa-utensils"></i>
                <a href="#" class="button">lunch</a>
            </li>
            <li>
                <i class="fa-solid fa-mug-hot"></i>
                <a href="#" class="button">soup</a>
            </li>
            <li>
                <i class="fa-solid fa-burger"></i>
                <a href="#" class="button">dinner</a>
            </li>
            <li>
                <i class="fa-solid fa-glass-water"></i>
                <a href="#" class="button">drinks</a>
            </li>
        </ul>
    </nav>
    <main>
        <header>
            <div class="add-meal header-button">
                <i class="fa-solid fa-plus"></i>
                add meal
            </div>
            <div class="search-bar">
                <form>
                    <input placeholder="search meal">
                </form>
            </div>
            <div class="settings header-button">
                <i class="fa-solid fa-gear"></i>
                settings
            </div>
        </header>
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
                <textarea name="list of ingredients" rows="8" placeholder="ingredients"></textarea>
                <input type="file" name="file">
                <button class="submit-button" type="submit">submit</button>
            </form>
        </section>
    </main>
</div>

</body>