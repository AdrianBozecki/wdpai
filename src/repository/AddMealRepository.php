<?php


require_once "Repository.php";
require_once __DIR__.'/../models/Meal.php';

class AddMealRepository extends Repository
{
    public function addMeal(Meal $meal): void
    {
        session_start();

        $date = new DateTime();
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO public.meals (title, preparation, ingredients, created_at, id_user, image, category, "like", dislike)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );

        $idUser = $_SESSION['user_id'];
        $imagePath = $meal->getImage() ? $meal->getImage() : 'public/uploads/default.png';

        $stmt->execute([
            $meal->getTitle(),
            $meal->getPreparation(),
            $meal->getIngredients(),
            $date->format('Y-m-d'),
            $idUser,
            $imagePath,
            $meal->getCategory(),
            $meal->getLike(),
            $meal->getDislike(),
        ]);
    }

}