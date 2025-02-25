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
        <!-- Top Summary Boxes -->
        <div class="row text-center">
            <div class="col-md-6">
                <div class="dashboard-box bg-primary">
                    <h4><i class="fas fa-user"></i> Total Users</h4>
                    <?php
                    $users = get_users($conn);
                    $user = $users->rowCount();
                    ?>
                    <h2><?= $user ?></h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dashboard-box bg-danger">
                    <?php
                    $admins = get_admins($conn);
                    $admin = $admins->rowCount();
                    ?>
                    <h4><i class="fas fa-user-shield"></i> Total Admins</h4>
                    <h2><?= $admin ?></h2>
                </div>
            </div>
        </div>

        <!-- User Prayer Table -->
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <h5>User Prayer Stats</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark">

                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of joining</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users = get_users($conn);
                        while ($user = $users->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?=$user['id']?></td>
                                <td><?=$user['name']?></td>
                                <td><?=$user['email']?></td>
                                <td><?=$user['date_join']?></td>
                               
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="manage_users.php" class="btn btn-primary my-3">Manage Users</a>
            </div>
        </div>
    </div>
</body>
<script src="../assets/js/admin.js"></script>

</html>