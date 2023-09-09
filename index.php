<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('meals', 'MealController');
Routing::post('login', 'SecurityController');
Routing::post('addMeal', 'AddMealController');
Routing::post('register', 'SecurityController');
Routing::post('search', 'MealController');
Routing::get('getMealsByCategory', 'MealController');
Routing::get('getMealDetails', 'MealController');

Routing::run($path);