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
        $stmt->bindParam(":email", $id, PDO::PARAM_INT);
        $stmt->execute();

        $meal = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$meal) {
            return null;
        }

        return new Meal(
            $meal['id'],
            $meal['title'],
            $meal['preparation'],
            $meal['ingredients'],
        );
    }

    public function getMeals(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.meals
        ');
        $stmt->execute();
        $meals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($meals as $meal) {
            $result[] = new Meal(
                $meal['title'],
                $meal['preparation'],
                $meal['ingredients'],
                $meal['image'],
            );
        }

        return $result;
    }

    public function addMeal(Meal $meal): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO public.meals (title, preparation, ingredients, created_at, id_user, image)
                    VALUES (?, ?, ?, ?, ?, ?)'
        );

        $idUser = 1;

        $stmt->execute([
            $meal->getTitle(),
            $meal->getPreparation(),
            $meal->getIngredients(),
            $date->format('Y-m-d'),
            $idUser,
            $meal->getImage(),
        ]);
    }

}