<?php


require_once "Repository.php";
require_once __DIR__.'/../models/Meal.php';

class MealRepository extends Repository
{
    public function getMeal(int $id): ?Meal
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.meals WHERE id = :id
        ');
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $meal = $stmt->fetch(PDO::FETCH_ASSOC);


        if (!$meal) {
            return null;
        }
        return new Meal(
            $meal['title'],
            $meal['preparation'],
            $meal['ingredients'],
            $meal['image'],
            $meal['category'],
            $meal['like'],
            $meal['dislike'],
        );
    }

    public function getMeals(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
        SELECT meals.*, user_details.name AS author 
        FROM public.meals
        JOIN users ON meals.id_user = users.id
        JOIN user_details ON users.id_user_details = user_details.id
        ORDER BY meals.id DESC;
    ');
        $stmt->execute();
        $meals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($meals as $meal) {
            $result[] = new Meal(
                $meal['title'],
                $meal['preparation'],
                $meal['ingredients'],
                $meal['image'],
                $meal['category'],
                $meal['author'],
                $meal['like'],
                $meal['dislike'],
                $meal['id'],
            );
        }

        return $result;
    }

    public function getMealsByCategory($category) {
        if($category == 'all') {
            $stmt = $this->database->connect()->prepare('
        SELECT meals.*, user_details.name AS author 
        FROM public.meals
        JOIN users ON meals.id_user = users.id
        JOIN user_details ON users.id_user_details = user_details.id
        ORDER BY meals.id DESC
        ');
        } else {
            $stmt = $this->database->connect()->prepare('
        SELECT meals.*, user_details.name AS author 
        FROM public.meals
        JOIN users ON meals.id_user = users.id
        JOIN user_details ON users.id_user_details = user_details.id
        WHERE category = :category
        ORDER BY meals.id DESC
        ');
            $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMealByTitle(string $searchString)
    {
        $searchString = "%".strtolower($searchString)."%";

        $stmt = $this->database->connect()->prepare(
            'SELECT meals.*, user_details.name AS author 
        FROM public.meals
        JOIN users ON meals.id_user = users.id
        JOIN user_details ON users.id_user_details = user_details.id
        WHERE LOWER(meals.title) LIKE :search'
        );
        $stmt->bindParam(":search", $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}