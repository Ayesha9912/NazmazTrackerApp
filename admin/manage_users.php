<?php
session_start();
include_once('../includes/config.php');
include_once('./admin_settings.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prayer Tracker Dashboard</title>
    <link rel="shortcut icon" href="assets/images/pngegg (1).png" type="image/x-icon">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Style css -->
    <link rel="stylesheet" href="../assets/style/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include_once('../includes/admin_header.php') ?>
    <div class="container mt-4">
        <!-- User Prayer Table -->
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <h5>Manage Users</h5>
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
                <table class="table table-striped">
                    <thead class="table-dark">

                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of joining</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users = get_users($conn);
                        while ($user = $users->fetch(PDO::FETCH_ASSOC)) { ?>
                            <form method="POST">
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['date_join'] ?></td>
                                    <td><button onclick="return confirm('Do you want to remove the user')" name="delete_user" class="btn btn-danger">Remove</button></td>

                                </tr>
                            </form>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="dashboard.php" class="btn btn-primary my-3">Go Back to home</a>
            </div>
        </div>
    </div>
</body>
<script src="../assets/js/admin.js"></script>

</html>