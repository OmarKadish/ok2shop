<?php
include("../config.php");
require(ROOT_PATH . "/server/db.php");
require (ROOT_PATH . "/server/admin_check.php");

$query = "SELECT id, concat(first_name, ' ', last_name) AS fullName, email, is_admin FROM users WHERE id <> ?";
$stmt = $conn->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="OK2shop An Online shopping platform">
    <meta name="author" content="Omar Kadish">
    <title>Omar's Shop</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../resources/css/styles.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="../resources/css/<?php echo $theme; ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
</head>
<body>
<?php include(ROOT_PATH . '/layout/header.php'); ?>

<section id="main-content">
    <div class="card">
        <p class="card-header">Users table</p>
        <table >
            <thead>
            <tr>
<!--                <th style="width:44px"></th>-->
                <th>Full name</th>
                <th>Role</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user):
//                $initials = strtoupper(substr($user['fullName'], 0, 1));
                $is_admin = $user['is_admin'] === 1;
                ?>
                <tr class="card-item">
<!--                    <td>-->
<!--                        <div class="avatar">--><?php //= $initials ?><!--</div>-->
<!--                    </td>-->
                    <td><?= htmlspecialchars($user['fullName']) ?></td>
                    <td>
                      <span class="badge <?= $is_admin ? 'badge-success' : 'badge-warning' ?>">
                        <?= $is_admin ? 'Admin' : 'User' ?>
                      </span>
                    </td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<script src=<?php echo ROOT_PATH . "/resources/script.js" ?>></script>
<?php include(ROOT_PATH . '/layout/footer.html'); ?>
