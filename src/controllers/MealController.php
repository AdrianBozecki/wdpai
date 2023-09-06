<?php



require_once 'AppController.php';
require_once __DIR__ .'/../models/Meal.php';
require_once __DIR__ .'/../repository/MealRepository.php';

class MealController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
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

    public function addMeal() {
        if ($this->isPost()) {
            // Sprawdzenie, czy plik został przesłany i jest poprawny
            if (is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
                );
                $meal = new Meal($_POST['title'], $_POST['preparation'], $_POST['ingredients'], $_FILES['file']['name'], $_POST['category']);
                $this->mealRepository->addMeal($meal);
                header('Location: /meals');
                return $this->render('meals', ['messages' => $this->message, 'meals' => $this->mealRepository->getMeals()]);
            } else {
                // Dodanie wiadomości o błędzie do tablicy
                $this->message[] = "Musisz podać zdjęcie";
                return $this->render('add_meal', ['messages' => $this->message]);
            }
        }
        return $this->render('add_meal', ['messages' => $this->message]);
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

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
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
            error_log(print_r($mealDetails, true));  // Dodanie logu
            header('Content-type:application/json');
            $mealArray = [
                'title' => $mealDetails->getTitle(),
                'preparation' => $mealDetails->getPreparation(),
                'ingredients' => $mealDetails->getIngredients(),
                'category' => $mealDetails->getCategory(),
                'like'=> $mealDetails->getLike(),
                'dislike'=> $mealDetails->getDislike()
            ];

            echo json_encode($mealArray);
        }
    }



}