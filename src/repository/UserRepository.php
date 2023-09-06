<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT u.id as user_id, u.email, u.password, ud.id as user_details_id, ud.name, ud.lastname
            FROM users u LEFT JOIN user_details ud ON u.id_user_details = ud.id
            WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['lastname'],
            "1",
            $user['user_id']
        );
    }

    public function addUser(User $user)
    {
        $db = $this->database->connect();  // Przechowuj jedną instancję PDO

        try {
            // Rozpoczęcie transakcji
            $db->beginTransaction();

            // Pierwsze zapytanie
            $stmt = $db->prepare('
            INSERT INTO user_details (name, lastname, phone)
            VALUES (?, ?, ?)
        ');

            $stmt->execute([
                $user->getName(),
                $user->getLastname(),
                $user->getPhone()
            ]);

            $userDetailsId = $db->lastInsertId();

            if (is_null($userDetailsId)) {
                throw new Exception('Could not retrieve user details ID.');
            }

            // Drugie zapytanie
            $stmt = $db->prepare('
            INSERT INTO users (email, password, id_user_details)
            VALUES (?, ?, ?)
        ');

            $stmt->execute([
                $user->getEmail(),
                $user->getPassword(),
                $userDetailsId
            ]);

            // Jeżeli wszystko poszło dobrze, zatwierdź transakcję
            $db->commit();
        } catch (Exception $e) {
            // Jeżeli coś poszło nie tak, wycofaj transakcję
            $db->rollBack();
            throw $e;
        }
    }
}


//    public function getUserDetailsId(User $user): int
//    {
//        $stmt = $this->database->connect()->prepare('
//            SELECT * FROM public.user_details WHERE name = :name AND lastname = :lastname
//        ');
//        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
//        $stmt->bindParam(':lastname', $user->getLastname(), PDO::PARAM_STR);
//        $stmt->execute();
//
//        $data = $stmt->fetch(PDO::FETCH_ASSOC);
//        return (int) $data['id'];
//    }
//}