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
                  <a href="/addMeal">
                      <i class="fa-solid fa-plus"></i>
                      add meal
                  </a>
              </div> 
              <div class="search-bar">
                <input placeholder="search">
              </div>
              <div class="settings header-button">
                <i class="fa-solid fa-gear"></i>
                  <a href="/login">
                   logout
                  </a>
              </div> 
            </header>
            <section class="meals">
                <?php foreach ($meals as $meal): ?>

                <div id="meal-1">
                  <img src="public/uploads/<?= $meal->getImage() ?>">
                  <div class="space">
                    <h2><?= $meal->getTitle() ?></h2>
                      <div class="like">
                          <i class="fas fa-heart"><?= $meal->getLike() ?></i>
                          <i class="fas fa-minus-square"><?= $meal->getDislike() ?></i>
                      </div>
                      <i class="author">author: <?= $meal->getAuthor() ?></i>
                  </div>
                </div>
                <?php endforeach; ?>
            </section>
        </main>
    </div>

</body>

<template id="meal-template">
    <div id="meal-1">
        <img src="">
        <div class="space">
            <h2>title</h2>
            <div class="like">
                <i class="fas fa-heart">0</i>
                <i class="fas fa-minus-square">0</i>
            </div>
            <i class="author">author: </i>
        </div>
    </div>
</template>