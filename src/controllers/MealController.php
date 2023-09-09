<?php



require_once 'AppController.php';
require_once __DIR__ .'/../models/Meal.php';
require_once __DIR__ .'/../repository/MealRepository.php';

class MealController extends AppController {

    private $messages = [];
    private $mealRepository;


    public function __construct()
    {
        parent::__construct();
        $this->mealRepository = new MealRepository();
    }

    public function meals() {
        $meals = $this->mealRepository->getMeals();
        $this->render('meals', ['meals' => $meals]);
    }

    public function search() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type:application/json');
            http_response_code(200);
            echo json_encode($this->mealRepository->getMealByTitle($decoded['search']));
        }
    }

    public function getMealsByCategory() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $category = $_GET['category'];

            header('Content-type:application/json');
            http_response_code(200);
            echo json_encode($this->mealRepository->getMealsByCategory($category));
        }
    }

    public function getMealDetails() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $id = $_GET['id'];

            $mealDetails = $this->mealRepository->getMeal($id);

            if ($mealDetails === null) {
                http_response_code(404);
                echo json_encode(['message' => 'Meal not found']);
                return;
            }

            header('Content-type:application/json');
            $mealArray = [
                'title' => $mealDetails->getTitle(),
                'preparation' => $mealDetails->getPreparation(),
                'ingredients' => $mealDetails->getIngredients(),
                'category' => $mealDetails->getCategory(),
                'like'=> $mealDetails->getLike(),
                'dislike'=> $mealDetails->getDislike(),
                'image' => $mealDetails->getImage(),
            ];

            echo json_encode($mealArray);
        }
    }



}