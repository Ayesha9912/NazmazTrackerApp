<?php
    session_start();
if(!isset($_SESSION['id'])){
    header('location:http://localhost/namazapp/pages/login.php');
}
include_once('../includes/config.php');

$user_id = $_SESSION['id'];
$today = date('Y-m-d');

// Fetch prayers submitted today
$stmt = $conn->prepare("SELECT prayer_name, status, updated_at FROM prayers_log WHERE user_id = ? AND date = ?");
$stmt->execute([$user_id, $today]);
$submitted_prayers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$prayer_statuses = [];
$prayer_times = [];

foreach ($submitted_prayers as $prayer) {
    $prayer_statuses[$prayer['prayer_name']] = $prayer['status'];
    $prayer_times[$prayer['prayer_name']] = $prayer['updated_at'];
}
// Insert or update prayer log if form is submitted9
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prayer_name = $_POST['prayer_name'];
    $status = $_POST['status'];

    // Check if the prayer log exists for today
    // $stmt = $conn->prepare("SELECT updated_at FROM prayers_log WHERE user_id = ? AND prayer_name = ? AND date = ?");
    // $stmt->execute([$user_id, $prayer_name, $today]);
    // $record = $stmt->fetch(PDO::FETCH_ASSOC);

    // if ($record) {
    //     $last_update = strtotime($record['updated_at']);
    //     $current_time = time();
    //     $hours_diff = ($current_time - $last_update) / 3600;

    //     if ($hours_diff < 24) {
    //         echo "<script>alert('You can only update this prayer after 24 hours from the last update.');</script>";
    //     } else {
    //         // Update the prayer record
    //         $stmt = $conn->prepare("UPDATE prayers_log SET status = ?, updated_at = NOW() WHERE user_id = ? AND prayer_name = ? AND date = ?");
    //         $stmt->execute([$status, $user_id, $prayer_name, $today]);
    //         echo "<script>alert('Prayer status updated successfully!'); window.location.reload();</script>";
    //     }
    // } else {
        // Insert a new record
        $stmt = $conn->prepare("INSERT INTO prayers_log (user_id, prayer_name, status, date, updated_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$user_id, $prayer_name, $status, $today]);
      

        if($status == 'missed'){
            $status = "pending";
            $insert_qaza = $conn->prepare('INSERT INTO `qaza_prayers`(user_id, prayer_name, original_date , status) VALUES (?,?,?,?)');
            $insert_qaza->execute([$user_id, $prayer_name, $today, $status]);
            
        }
        header('location:'.$_SERVER['PHP_SELF']);
    // }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Userdashboard - Importance of Namaz</title>
    <link rel="shortcut icon" href="assets/images/pngegg (1).png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/style/fronted.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include_once('../components/user_header.php'); ?>

    <div class="container prayer-conatiner mt-5">
        <h2 class="text-center">Today's Prayers</h2>
        <p class="text-dark text-center"><span class="text-danger">* </span>You can update the table after every 24 hours</p>

        <table class="table table-bordered text-center mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Prayer Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $prayers = ['Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
                foreach ($prayers as $prayer) {
                    $last_update_time = isset($prayer_times[$prayer]) ? strtotime($prayer_times[$prayer]) : 0;
                    $current_time = time();
                    $hours_diff = ($current_time - $last_update_time) / 3600;
                ?>
                    <tr>
                        <td><?= $prayer ?></td>
                        <td>
                            <?php if ($hours_diff >= 24) : ?>
                                <form method="POST" class="prayer-form">
                                    <input type="hidden" name="prayer_name" value="<?= $prayer ?>">
                                    <button type="submit" name="status" value="completed" class="btn btn-success prayer-btn">✔ Completed</button>
                                    <button type="submit" name="status" value="missed" class="btn btn-danger prayer-btn">✘ Missed</button>
                                </form>
                            <?php else : ?>
                                <?php if (isset($prayer_statuses[$prayer])) : ?>
                                    <span class="text-<?= $prayer_statuses[$prayer] == 'completed' ? 'success' : 'danger' ?>">
                                        <?= ucfirst($prayer_statuses[$prayer]) ?> (Last updated: <?= date('h:i A', strtotime($prayer_times[$prayer])) ?>)
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div>
            <h3 class="text-center mt-5">Your Previous History</h3>
            <table class="table table-bordered text-center mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Sr#</th>
                        <th>Prayer Name</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->prepare('SELECT * FROM `prayers_log` WHERE user_id = ?');
                    $stmt->execute([$user_id]);
                    $index = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?= $index++ ?></td>
                            <td><?= $row['prayer_name'] ?></td>
                            <td class="text-<?= $row['status'] == 'completed' ? 'success' : 'danger' ?>">
                                <?= ucfirst($row['status']) ?>
                            </td>
                            <td><?= $row['date'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once('../components/user_footer.php'); ?>
</body>
</html>