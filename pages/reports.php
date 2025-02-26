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
$status = "completed";
$total_prayers = $conn->prepare('SELECT * FROM `prayers_log` WHERE user_id = ? AND status = ?');
$total_prayers->execute([$user_id, $status]);
$total_num = $total_prayers->rowCount();

$total_qaza = $conn->prepare('SELECT * FROM `qaza_prayers` WHERE user_id = ?');
$total_qaza->execute([$user_id]);
$qaza_num = $total_qaza->rowCount();

$pending = 'pending';
$qaza_pending = $conn->prepare('SELECT * FROM `qaza_prayers` WHERE user_id = ? AND status = ?');
$qaza_pending->execute([$user_id, $pending]);
$qaza_pend = $qaza_pending->rowCount();

$completed = 'completed';
$qaza_compl = $conn->prepare('SELECT * FROM `qaza_prayers` WHERE user_id = ? AND status = ?');
$qaza_compl->execute([$user_id, $completed]);
$qaza_comp = $qaza_compl->rowCount();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Page</title>
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

    <div class="container prayer-conatiner chart-cont">
        <div class="mt-4 chart-div">
            <h4 class="text-center my-5">Prayer Status Summary</h4>
            <canvas id="prayerChart" width="400" height="200"></canvas>
        </div>

    </div>


    <!-- Footer -->
    <?php include_once('../components/user_footer.php') ?>


</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('prayerChart').getContext('2d');
    var prayerChart = new Chart(ctx, {
        type: 'pie', // You can change to 'bar' or other types if you want
        data: {
            labels: ['Total', 'total_qaza', 'pending' , 'qaza completed'],
            datasets: [{
                label: 'Prayer Status',
                data: [
                    <?= $total_num ?>,
                    <?=$qaza_num?>,
                    <?=$qaza_pend?>,
                    <?=$qaza_comp?>
                   
                ],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545','#0D6EFD'],
                borderColor: ['#28a745', '#ffc107', '#dc3545', '#0D6EFD'],
                borderWidth: 3
            }]
        }
    });
</script>

</html>