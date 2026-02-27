<?php
//helper functions for dealing with security

class Security {

    public static function checkHTTPS() {
        //if not HTTPS, redirect to https:// version and exit
        if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') {
            $host = $_SERVER['HTTP_HOST'];
            $uri = $_SERVER['REQUEST_URI'];
            header('Location: https://' . $host . $uri);
            exit();
        }
    }

    //perform any needed clean-up for logging out
    public static function logout() {
        //clear session data and destroy the session so the user must login again
        session_unset();
        session_destroy();

        //start a new session only to carry a one-time message back to the login page
        session_start();
        $_SESSION['logout_msg'] = 'Successfully logged out.';
        header('Location: ../index.php');
        exit();
    }

    //require any authenticated login
    public static function requireLogin() {
        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            $_SESSION['logout_msg'] = 'Please login to access the application.';
            header('Location: ../index.php');
            exit();
        }
    }

    //require a specific UserLevel (1 = admin, 2 = user, 3 = tech)
    public static function requireLevel($level) {
        self::requireLogin();
        if (!isset($_SESSION['user_level']) || intval($_SESSION['user_level']) !== intval($level)) {
            $_SESSION['logout_msg'] = 'Current login unauthorized for this page.';
            header('Location: ../index.php');
            exit();
        }
    }
}
