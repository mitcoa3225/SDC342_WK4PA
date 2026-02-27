<?php
session_start();
require_once(__DIR__ . '/../util/security.php');

Security::checkHTTPS();
Security::requireLevel(3);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mitchell Coates Wk 4 Performance Assessment</title>
</head>
<body>
    <h1>Open Incidents</h1>

    <p><a href="tech_nav.php">Home</a></p>

    <form method="POST" action="logout.php">
        <input type="submit" value="Logout">
    </form>

    <h2>Incidents</h2>
    <ul>
        <li>INC-1001 - Printer not working</li>
        <li>INC-1002 - Password reset requested</li>
        <li>INC-1003 - Network outage reported</li>
    </ul>
</body>
</html>
