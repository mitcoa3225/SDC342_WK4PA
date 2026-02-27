<?php
session_start();
require_once(__DIR__ . '/../util/security.php');

Security::checkHTTPS();
Security::requireLevel(2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mitchell Coates Wk 4 Performance Assessment</title>
</head>
<body>
    <h1>Mitchell Coates Wk 4 Performance Assessment</h1>
    <h1>Products</h1>

    <p><a href="user_nav.php">Home</a></p>

    <form method="POST" action="logout.php">
        <input type="submit" value="Logout">
    </form>

    <h2>Product List</h2>
    <ul>
        <li>Product A</li>
        <li>Product B</li>
        <li>Product C</li>
    </ul>
</body>
</html>
