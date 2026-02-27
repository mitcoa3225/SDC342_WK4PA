<?php
require_once(__DIR__ . '/../model/user_db.php');
require_once(__DIR__ . '/user.php');

class UserController {

    //helper function to convert a db row into a User object
    private static function rowToUser($row) {
        $user = new User(
            $row['FirstName'],
            $row['LastName'],
            $row['EMail'],
            $row['Password'],
            $row['RegistrationDate'],
            $row['UserLevel'],
            $row['UserId']
        );
        return $user;
    }

    //get a User object by email (returns false if not found)
    public static function getUser($email) {
        $queryRes = UsersDB::getUserByEmail($email);
        if ($queryRes) {
            return self::rowToUser($queryRes);
        }
        return false;
    }

    //function to check login credentials - return the user's level if valid, false otherwise
    //login identifier is EMail
    public static function validUser($email, $password) {
        $queryRes = UsersDB::getUserByEmail($email);
        if ($queryRes) {
            //process the user row
            $user = self::rowToUser($queryRes);

            //database stores plaintext in this assignment
            if ($user->getPassword() === $password) {
                return intval($user->getUserLevel());
            } else {
                return false;
            }
        } else {
            //either no such user or db connect failed
            return false;
        }
    }
}
