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
    <h1>Manage Incidents</h1>

    <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>

    <p><a href="open_incidents.php">View Open Incidents</a></p>

    <form method="POST" action="logout.php">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
