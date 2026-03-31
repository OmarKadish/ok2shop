<?php
require('auth.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .main {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 10px solid;

        }

        label {
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="textarea"] {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button[type="submit"] {
            padding: 15px;
            border-radius: 10px;
            border: none;
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>

<body>
    <div class="main">
        <h2>Registration Form</h2>
        <form action="auth.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />
            <button name="log_user" type="submit">
                Submit
            </button>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
            <p>Go home <a href="../index.php">here</a></p>
        </form>
    </div>
</body>

</html>