<?php
    require_once("db.php");
    // initializing variables
    $first_name = $last_name = $address = $email = $password = $phone = '';
    $validatSign = array(
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'password' => '',
        'address' => '',
        'phone' => ''
    );
    $validateLog = array('failure' => '', 'email' => '', 'password' => '');

    // REGISTER USER
    if (isset($_POST['reg_user'])) {
        // receive all input values from the form
        //validate the first_name
        if (empty($_POST['first_name'])) {
            $validatSign['first_name'] = 'This Field is required.';
        } else {
            $first_name = $_POST['first_name'];
        }
        //validate the last_name
        if (empty($_POST['last_name'])) {
            $validatSign['last_name'] = 'This Field is required.';
        } else {
            $last_name = $_POST['last_name'];
        }
        //validate the address (optional)
        // if (empty($_POST['address'])) {
        //     $validatSign['address'] = 'This Field is required.';
        // } else {
        //     $birthDate = $_POST['address'];
        // }
        $address = $_POST['address'];

        //validate the phone
        if (empty($_POST['phone'])) {
            $validatSign['phone'] = 'This Field is required.';
        } else {
            $phone = $_POST['phone'];
        }
        //validate the email
        if (empty($_POST['email'])) {
            $validatSign['email'] = 'This Field is required.';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $validatSign['email'] = 'Entered Email is Not valid!!';
        } else {
            $email = $_POST['email'];
        }

        //validate the password
        if (empty($_POST['password'])) {
            $validatSign['password'] = 'This Field is required.';
        } else {
            $password = $_POST['password'];
        }


        // Finally, register user if there are no errors in the form
        if (!array_filter($validatSign)) {
            $enc_password = password_hash($password, PASSWORD_DEFAULT); //encrypt the password before saving in the database

            $query = "INSERT INTO users (first_name, last_name, email, address, phone, password) 
                            VALUES(?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$first_name, $last_name, $email, $address, $phone, $enc_password]);

            header('location: login.php');
        }
    }


    // LogIn USER
    if (isset($_POST['log_user'])) {
        echo $_POST['log_user'];

        //validate the email
        if (empty($_POST['email'])) {
            $validateLog['email'] = 'This Field is required.';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $validateLog['email'] = 'Entered Email is Not valid!!';
        } else {
            $email = $_POST['email'];
        }

        //validate the password
        //validate the password
        if (empty($_POST['password'])) {
            $validateLog['password'] = 'This Field is required.';
        } else {
            $password = $_POST['password'];
        }

        if (!array_filter($validateLog)) {
            //hashing the password to compare it.
            //$chk_password = password_hash($password, PASSWORD_DEFAULT);
            //check the database to make sure a user does not already exist with the same email
            $user_check_query = "SELECT * FROM users WHERE email=?";
            $result = $conn->prepare($user_check_query);

            $result->execute([$email]);
            $user = $result->fetch();
            echo $user['id'];
            if ($user && password_verify($password, $user['password'])) { // if user exists
                $_SESSION['user_name'] = $user['first_name'];
                $_SESSION['user_id'] = $user['id'];
                header('Location:' . "/");
            } else
                $validateLog['failure'] = 'Invalid login, Incorrect Email or Password';
        }
    }
