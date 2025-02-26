<?php
session_start();
include_once('../includes/config.php');
if (isset($_SESSION['admin_login'])) {
    header('location:dashboard.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
     
    $user_name = $_POST['name'];
    $user_password = $_POST['password'];

    $user_pass = $user_password;

    $user_pass = sha1($user_pass);
    $user_pass = filter_var($user_password, FILTER_SANITIZE_STRING);

    $get_admin = $conn->prepare('SELECT * FROM `admin`');
    $get_admin->execute();
    $row = $get_admin->fetch(PDO::FETCH_ASSOC);
    $name = $row['name'];
    $pass = $row['pass'];

    $u_name = 'admin';
    $password = '123123';
    
    if($user_name == $name OR $user_name == $u_name AND $user_password == $password OR $user_pass == $pass){
        $_SESSION['admin_login'] = true;
        $_SESSION['admin_name'] = $user_name;
        header('location:dashboard.php');
        exit();
    }else{
        $error = 'Invalid user and password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/pngegg (1).png" type="image/x-icon">

</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card p-4 shadow-sm">
        <h4 class="text-center">Admin Login</h4>
        <p class="text-center">Username: admin <br> Password: 123123</p>

        <?php if (isset($error)): ?>
            <p class="text-danger text-center"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

</body>

</html>