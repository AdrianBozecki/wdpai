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

    public function addMeal()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $meal = new Meal($_POST['title'],$_POST['preparation'], $_POST['ingredients'], $_FILES['file']['name']);
            $this->mealRepository->addMeal($meal);

            return $this->render('meals', ['messages' => $this->message, 'meal' => $meal]);
        }
        return $this->render('add_meal', ['messages' => $this->message]);
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
}