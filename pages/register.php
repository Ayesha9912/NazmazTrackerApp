<?php
session_start();
include_once('../middleware/auth.php');
include_once('../middleware/auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="shortcut icon" href="assets/images/pngegg (1).png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/style/fronted.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include_once('../components/user_header.php') ?>
    <!-- Container Wrapper -->
    <div class="container-fluid container-wrapper">
        <div class="container">
            <div class="register-card text-center mx-auto">
                <h2 class="mb-4 text-primary">Create an Account</h2>
                <?php
                if (isset($error)) {
                    foreach ($error as $errors) { ?>
                        <p id="msg" class="text-danger"><?= $errors ?></p>
                        <?php
                    }
                }
                ?>
                <?php
                if (isset($msg)) {
                    foreach ($msg as $msgs) { ?>
                        <p id="msg" class="text-success"><?= $msgs ?></p>
                        <?php
                    }
                }
                ?>
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="pass" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="cpass" class="form-control" placeholder="Confirm Password"
                            required>
                    </div>
                    <button name="register_user" type="submit" class="btn btn-register w-100">Register</button>
                </form>
                <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
    <?php include_once('../components/user_footer.php'); ?>
</body>

</html>