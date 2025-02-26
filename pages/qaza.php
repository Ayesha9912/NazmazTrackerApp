<?php
session_start();
include_once('../includes/config.php');
if (!isset($_SESSION['id'])) {
    header('location:http://localhost/namazapp/pages/login.php');
}
$user_id = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $current_date = date('Y-m-d');
    $new_status = "completed";
    $stmt = $conn->prepare('UPDATE `qaza_prayers` SET status = ? , qaza_date = ? WHERE qaza_id = ?');
    $stmt->execute([$new_status, $current_date, $id]);
    $msg = "the status is updataed successfully";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qaza History</title>
    <link rel="shortcut icon" href="assets/images/pngegg (1).png" type="image/x-icon">


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

    <!-- Main Content -->

    <div class="container prayer-conatiner">
        <?php if (isset($msg)) { ?>
            <p class="text-success"><?=$msg?></p>
            <?php

        } ?>
        <h3 class="text-center">Qaza Missed Prayers</h3>
        <table class="table table-bordered text-center mt-4">
            <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Prayer Name</th>
                    <th>Original Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch qaza prayers from the database
                $status = "pending";
                $stmt = $conn->prepare('SELECT * FROM qaza_prayers WHERE user_id = ? AND status = ?');
                $stmt->execute([$user_id, $status]);

                $index = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?= $index++ ?></td>
                        <td><?= htmlspecialchars($row['prayer_name']) ?></td>
                        <td><?= htmlspecialchars($row['original_date']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $row['qaza_id'] ?>">
                                <button type="submit" class="btn btn-success">Complete</button>
                            </form>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


        <h3 class="text-center">Qaza Prayers</h3>
        <table class="table table-bordered text-center mt-4">
            <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Prayer Name</th>
                    <th>Original Date</th>
                    <th>Qaza date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch qaza prayers from the database
                $updated_status = "completed";
                $stmt = $conn->prepare('SELECT * FROM qaza_prayers WHERE user_id = ? AND status = ?');
                $stmt->execute([$user_id, $updated_status]);

                $index = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?= $index++ ?></td>
                        <td><?= htmlspecialchars($row['prayer_name']) ?></td>
                        <td><?= htmlspecialchars($row['original_date']) ?></td>
                        <td><?= htmlspecialchars($row['qaza_date']) ?></td>
                        <td>Completed</td>
                      
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>



    <!-- Importance of Namaz Section -->


    <!-- Footer -->
    <?php include_once('../components/user_footer.php') ?>
    <!-- 
<script>
    // Auto-update year
    document.getElementById("year").textContent = new Date().getFullYear();
</script> -->

</body>

</html>