<?php
//Class to represent an entry in the users table
class User {
    //properties - match the columns in the users table
    private $userId;
    private $firstName;
    private $lastName;
    private $eMail;
    private $password;
    private $registrationDate;
    private $userLevel;

    public function __construct(
        $firstName,
        $lastName,
        $eMail,
        $password,
        $registrationDate,
        $userLevel,
        $userId = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->eMail = $eMail;
        $this->password = $password;
        $this->registrationDate = $registrationDate;
        $this->userLevel = $userLevel;
        $this->userId = $userId;
    }

    //get and set the user properties
    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($value) {
        $this->userId = $value;
    }

    public function getFirstName() {
        return $this->firstName;
    }
    public function setFirstName($value) {
        $this->firstName = $value;
    }

    public function getLastName() {
        return $this->lastName;
    }
    public function setLastName($value) {
        $this->lastName = $value;
    }

    public function getEMail() {
        return $this->eMail;
    }
    public function setEMail($value) {
        $this->eMail = $value;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($value) {
        $this->password = $value;
    }

    public function getRegistrationDate() {
        return $this->registrationDate;
    }
    public function setRegistrationDate($value) {
        $this->registrationDate = $value;
    }

    public function getUserLevel() {
        return $this->userLevel;
    }
    public function setUserLevel($value) {
        $this->userLevel = $value;
    }
}
