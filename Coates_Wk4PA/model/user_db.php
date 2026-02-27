<?php
require_once(__DIR__ . '/database.php');

//class for users table queries
class UsersDB {

    //function to get a user by their UserId
    public static function getUserById($userId) {
        //get the DB connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            //basic validation - only allow numbers for the id
            $userId = intval($userId);

            //create the query string
            $query = "SELECT * FROM users WHERE users.UserId = $userId";

            //execute the query
            $result = $dbConn->query($query);
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
            return false;
        } else {
            return false;
        }
    }

    //function to get all users (for admin view)
    public static function getAllUsers() {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "SELECT UserId, FirstName, LastName, EMail, RegistrationDate, UserLevel FROM users ORDER BY UserId";
            $result = $dbConn->query($query);
            return $result;
        }

        return false;
    }
}
