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
                $meal['category'],

            );
        }

        return $result;
    }

    public function getMealsByCategory($category) {
        if($category == 'all') {
            $stmt = $this->database->connect()->prepare("SELECT * FROM public.meals");
        } else {
            $stmt = $this->database->connect()->prepare(
                "SELECT * FROM public.meals WHERE category = :category"
            );
            $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addMeal(Meal $meal): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO public.meals (title, preparation, ingredients, created_at, id_user, image, category)
                    VALUES (?, ?, ?, ?, ?, ?, ?)'
        );

        $idUser = 1;

        $stmt->execute([
            $meal->getTitle(),
            $meal->getPreparation(),
            $meal->getIngredients(),
            $date->format('Y-m-d'),
            $idUser,
            $meal->getImage(),
            $meal->getCategory(),
        ]);
    }

    public function getProjectByTitle(string $searchString)
    {
        $searchString = "%".strtolower($searchString)."%";

        $stmt = $this->database->connect()->prepare(
          "SELECT * FROM public.meals WHERE LOWER(title) LIKE :search"
        );
        $stmt->bindParam(":search", $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}