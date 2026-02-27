<?php
session_start();
require_once(__DIR__ . '/../util/security.php');
require_once(__DIR__ . '/../model/user_db.php');

Security::checkHTTPS();
Security::requireLevel(1);

$usersRes = UsersDB::getAllUsers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mitchell Coates Wk 4 Performance Assessment</title>
</head>
<body>
    <h1>View User Accounts</h1>

    <p><a href="admin_nav.php">Home</a></p>

    <form method="POST" action="logout.php">
        <input type="submit" value="Logout">
    </form>

    <h2>Accounts</h2>

    <?php if ($usersRes === false) { ?>
        <p>Unable to load user accounts.</p>
    <?php } else { ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>UserId</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>EMail</th>
                <th>RegistrationDate</th>
                <th>UserLevel</th>
            </tr>
            <?php while ($row = $usersRes->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['UserId']); ?></td>
                    <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
                    <td><?php echo htmlspecialchars($row['LastName']); ?></td>
                    <td><?php echo htmlspecialchars($row['EMail']); ?></td>
                    <td><?php echo htmlspecialchars($row['RegistrationDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['UserLevel']); ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</body>
</html>
