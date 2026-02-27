<?php
session_start();

require_once(__DIR__ . '/controller/user.php');
require_once(__DIR__ . '/controller/user_controller.php');
require_once(__DIR__ . '/util/security.php');

Security::checkHTTPS();

//set the message related to login/logout functionality
$login_msg = isset($_SESSION['logout_msg']) ? $_SESSION['logout_msg'] : '';
unset($_SESSION['logout_msg']);

if (isset($_POST['user_id']) && isset($_POST['pw'])) {
    //login fields were set
    $user_level = UserController::validUser($_POST['user_id'], $_POST['pw']);

    if ($user_level !== false) {
        //store login info in the session
        $userObj = UserController::getUser($_POST['user_id']);

        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = intval($_POST['user_id']);
        $_SESSION['user_level'] = strval($user_level);
        $_SESSION['user_name'] = $userObj ? ($userObj->getFirstName() . ' ' . $userObj->getLastName()) : '';

        if (strval($user_level) === '1') {
            header('Location: view/admin_nav.php');
            exit();
        } else if (strval($user_level) === '2') {
            header('Location: view/user_nav.php');
            exit();
        } else if (strval($user_level) === '3') {
            header('Location: view/tech_nav.php');
            exit();
        } else {
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
        <h3>User ID: <input type="text" name="user_id"></h3>
        <h3>Password: <input type="password" name="pw"></h3>
        <input type="submit" value="Login" name="login">
    </form>

    <h3><?php echo $login_msg; ?></h3>
</body>
</html>
