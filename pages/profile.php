<?php
include_once('../includes/config.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_user_profile'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $id = $_POST['user_id'];

        $prev_pass = $_POST['pass']; // Hashed password stored in DB
        $pass = sha1($_POST['prev_pass']); // Hashed user input
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        // Validate previous password
        if ($pass !== $prev_pass) {
            $error[] = 'Your Previous Password does not match';
        } else {
            // Check if new password is provided
            if (!empty($_POST['new_pass'])) {
                $new_pass = sha1($_POST['new_pass']);
                $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
                $update_profile = $conn->prepare('UPDATE `users` SET name = ?, password = ? WHERE id = ?');
                $update_profile->execute([$name, $new_pass, $id]);
            } else {
                $update_profile = $conn->prepare('UPDATE `users` SET name = ? WHERE id = ?');
                $update_profile->execute([$name, $id]);
            }

            $msg[] = "Profile is updated successfully";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Importance of Namaz</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="../assets/style/fronted.css?v=<?php echo time(); ?>">
</head>
<body>
<!-- Header Section -->
<?php include_once('../components/user_header.php') ?>
<div class="container mt-5 prayer-conatiner m-auto">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>User Profile Settings</h4>
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
        </div>
        <div class="card-body">
         
            <?php
            $select_user = $conn->prepare('SELECT * FROM `users` WHERE id = ?');
            $select_user->execute([$_SESSION['id']]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);
             ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                    <input name="name" type="text" value="<?= $row['name'] ?>" class="form-control"
                        placeholder="Enter new username">
                </div>

                <div class="mb-3">
                    <label class="form-label">Previous Password</label>
                    <input type="hidden" name="pass" value="<?= $row['password']; ?>">
                    <input type="password" name="prev_pass" class="form-control"
                        placeholder="Enter previous password">
                </div>

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_pass" class="form-control" placeholder="Enter new password">
                </div>

                <button name="update_user_profile" type="submit" class="btn btn-success">Update Profile</button>
            </form>
        </div>
    </div>
</div>








<!-- Footer -->
<?php include_once('../components/user_footer.php') ?>
<!-- 
<script>
    // Auto-update year
    document.getElementById("year").textContent = new Date().getFullYear();
</script> -->

</body>
</html>
