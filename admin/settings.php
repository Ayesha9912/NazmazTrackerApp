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
    <title>Admin Settings</title>
    <link rel="shortcut icon" href="assets/images/pngegg (1).png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
    <?php include_once('../includes/admin_header.php') ?>
    <div class="container">
        <h2 class="mb-4">Admin Settings</h2>
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
        <!-- Bootstrap Tabs -->
        <ul class="nav nav-tabs" id="settingsTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#general">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#profile">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#users">Manage Admins</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#registerAdmin">Register Admin</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- General Settings Tab -->
            <div id="general" class="tab-pane fade show active">
                <h4 class="mt-3">General Settings</h4>

                <!-- <div class="mb-3">
                        <label class="form-label">Site Logo</label>
                        <input type="file" class="form-control">
                    </div> -->
                <div class="mb-3">
                    <label class="form-label">Site code</label>

                    <textarea class="form-control" name="" id="preview_content" rows="3"><i class="fas fa-mosque"></i>$nbsp;<span>Prayer Tracker</span> 

                        </textarea>
                </div>
                <button onclick="previewMode()" class="btn btn-primary">Save Changes</button>
            </div>

            <!-- Profile Settings Tab -->
            <div id="profile" class="tab-pane fade">
                <h4 class="mt-3">Profile Settings</h4>
                <?php
                if ($_SESSION['admin_name'] === 'admin') {
                    echo ' 
                   <p class="text-danger">You cannot update the default admin! </p>';
                }
                ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input name="name" type="text" value="<?= $_SESSION['admin_name'] ?>" class="form-control"
                            placeholder="Enter new username">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Previous Password</label>
                        <input type="hidden" name="pass" value="<?= $row['pass'] ?>">
                        <input type="password" name="prev_pass" class="form-control"
                            placeholder="Enter  previous Password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_pass" class="form-control" placeholder="Enter new Password">
                    </div>
                    <button name="update_user" type="submit" class="btn btn-success">Update Profile</button>
                </form>
            </div>
            <!-- Manage Users Tab -->
            <div id="users" class="tab-pane fade">
                <h4 class="mt-3">Manage Admins</h4>
                <form method="POST">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $admins = get_admins($conn);
                            $index = 1;
                            while ($admin = $admins->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <form method="POST">
                                    <tr>
                                        <td><?= $index++ ?></td>
                                        <td><?= htmlspecialchars($admin['name']) ?></td>
                                        <?php echo $admin['id'] ?>
                                        <td><?= htmlspecialchars($admin['email']) ?></td>
                                        <td>Admin</td>
                                        <input type="hidden" name="id" value="<?= $admin['id'] ?>">
                                        <td><button onclick="return confirm('Do you want to delete the admin')"
                                                name="delete_admin" class="btn btn-danger btn-sm">Remove</button></td>
                                    </tr>
                                </form>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- Register New Admin Tab -->
            <div id="registerAdmin" class="tab-pane fade">
                <h4 class="mt-3">Register New Admin</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Enter full name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input name="pass" type="password" class="form-control" placeholder="Enter password">
                    </div>
                    <button name="register_admin" type="submit" class="btn btn-primary">Register Admin</button>
                </form>
            </div>
        </div>
    </div>
    <?php include_once('../includes/admin_footer.php') ?>
    <script src="../assets/js/admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>