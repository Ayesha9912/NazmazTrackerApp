<?php
// if (!isset($_SESSION['name'])) {
//     $_SESSION['name'] = '';
// }
include_once('../includes/config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register_user'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $select_user = $conn->prepare('SELECT * FROM `users` WHERE name = ? AND email = ?');
        $select_user->execute([$name, $email]);

        if ($select_user->rowCount() > 0) {
            $error[] = 'The user already registered';
        } else {
            if ($pass != $cpass) {
                $error[] = 'The confirm password doesnot match';
            } else {
                $insert_user = $conn->prepare('INSERT INTO `users` (name , email , password) VALUES(?,?,?)');
                $insert_user->execute([$name, $email, $pass]);
                $msg[] = 'The user is successfully regietred';
                $_SESSION['name'] = $name;
                $select_inserted_user = $conn->prepare('SELECT * FROM `users` WHERE name = ? AND email = ? AND  password = ? ');
                $select_inserted_user->execute([$name, $email, $pass]);
                $row = $select_inserted_user->fetch(PDO::FETCH_ASSOC);
                $_SESSION['id'] = $row['id'];
                header('location:http://localhost/namazapp');
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login_user'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        // Corrected SQL query to fetch user by email
        $select_user = $conn->prepare('SELECT * FROM `users` WHERE email = ?');
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($row) { // Check if user exists
            $id = $row['id'];
            $user_name = $row['name'];
            $user_email = $row['email'];
            $user_pass = $row['password']; // Fixed variable name

            if ($email === $user_email && $pass === $user_pass) { // Fixed condition
                $_SESSION['name'] = $user_name;
                $_SESSION['id'] = $id;
                header('Location: http://localhost/namazapp');
                exit();
            } else {
                $error[] = 'The login credentials are incorrect';
            }
        } else {
            $error[] = 'User not found';
        }
    }
}
?>