<?php
session_start();
include_once('../middleware/auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/style/fronted.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include_once('../components/user_header.php'); ?>
    <!-- Container Wrapper -->
    <div class="container-fluid container-wrapper">
        <div class="container">
            <div class="register-card text-center mx-auto">
                <h2 class="mb-4 text-primary">Login Now!</h2>
                <?php
                if (isset($error)) {
                    foreach ($error as $errors) { ?>
                        <p id="msg" class="text-danger"><?= $errors ?></p>
                        <?php
                    }
                }
                ?>
                <form method="POST">
                    <div class="mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="mb-3">
                        <input name="pass" type="password" class="form-control" placeholder="Password" required>
                    </div>

                    <button name="login_user" type="submit" class="btn btn-register w-100">Login</button>
                </form>
                <p class="mt-3">Don't have an account <a href="register.php">Register</a></p>
            </div>
        </div>
    </div>
    <?php include_once('../components/user_footer.php') ?>
</body>

</html>