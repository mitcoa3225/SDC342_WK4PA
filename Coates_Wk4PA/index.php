<?php
session_start();

require_once(__DIR__ . '/controller/user.php');
require_once(__DIR__ . '/controller/user_controller.php');
require_once(__DIR__ . '/util/security.php');

Security::checkHTTPS();

//set the message related to login/logout functionality
$login_msg = isset($_SESSION['logout_msg']) ? $_SESSION['logout_msg'] : '';
unset($_SESSION['logout_msg']);

if (isset($_POST['email']) && isset($_POST['pw'])) {
    //login fields were set
    //login identifier is the EMail field in the database
    $user_level = UserController::validUser($_POST['email'], $_POST['pw']);

    if ($user_level !== false) {
        //store login info in the session
        $userObj = UserController::getUser($_POST['email']);

        $_SESSION['logged_in'] = true;
        //store the database UserId (still used in some places) and the login email
        $_SESSION['user_id'] = $userObj ? intval($userObj->getUserId()) : 0;
        $_SESSION['email'] = strval($_POST['email']);
        //store as an int-like value for easy comparisons
        $_SESSION['user_level'] = intval($user_level);
        $_SESSION['user_name'] = $userObj ? ($userObj->getFirstName() . ' ' . $userObj->getLastName()) : '';

        //send the user to the correct navigation page based on the UserLevel stored in the database
        switch (intval($user_level)) {
            case 1:
                header('Location: view/admin_nav.php');
                exit();
            case 2:
                header('Location: view/user_nav.php');
                exit();
            case 3:
                header('Location: view/tech_nav.php');
                exit();
            default:
                //unexpected user level
                $login_msg = 'Login failed - invalid user level.';
                $_SESSION['logged_in'] = false;
        }
    } else {
        $login_msg = 'Login credentials were incorrect.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mitchell Coates Wk 4 Performance Assessment</title>
</head>
<body>
    <h1>Mitchell Coates Wk 4 Performance Assessment</h1>
    <h2>Mitchell Coates Application Login</h2>

    <form method="POST" action="index.php">
        <h3>User ID (Email): <input type="text" name="email"></h3>
        <h3>Password: <input type="password" name="pw"></h3>
        <input type="submit" value="Login" name="login">
    </form>

    <h3><?php echo $login_msg; ?></h3>
</body>
</html>
