<?php
session_start();
include_once('../includes/config.php');
$user_id = $_SESSION['id'];
$today = date('Y-m-d');

$select_prayer = $conn->prepare('SELECT * FROM `prayers_log` WHERE user_id = ? AND date = ?');
$select_prayer->execute([$user_id, $today]);
$submitted_prayers = $select_prayer->fetch(PDO::FETCH_ASSOC);

$prayer_statuses = [];

foreach($submitted_prayers as $prayers){
    $prayer_statuses[$prayer['prayer_name']] = $prayer['status'];
}




if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $prayer_name = $_POST['prayer_name'];
    $status = $_POST['starus'];
    if(!isset($prayer_statuses[$prayer_name])){
        $stmt = $conn->prepare('INSERT INTO `prayers_log` (user_id , prayer_name , status , date) VALUES (?,?,?,?)');
        $stmt->execute([$user_id, $prayer_name , $status , $today]);
        header('location:'.$_SERVER['PHP_SELF']);
        exit();
    }else{
        print_r($stmt->errorInfo());
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

    <div class="container prayer-container">
        <h2>Today's Prayers</h2>

        <table class="table table-bordered text-center mt-5">
            <thead class="table-dark">
                <tr>
                    <th>Prayer Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $prayers = ['Fajr', 'Dhur', 'asr', 'Maghrib', 'Isha'];
                foreach ($prayers as $prayer) { ?>
                <td><?=$prayer?></td>
                <?php
                if(isset($prayer_statuses[$prayer]))?>
                <p class="text-<?=$prayer_statuses[$prayer] == 'completed' ? 'success': 'danger' ?>"><?= ucfirst($prayer_statuses[$prayer])?></p>
                <button class="btn btn-success" disabled></button>
                <button class="btn btn-success" disabled></button>
                
                <?php
                 ?>

                <form action="POST">
                    <input type="hidden" name="prayer_name" value="<?=$prayer?>">
                    <td>
                        <button class="btn btn-success" name="status" value="completed">✔ Completed</button>
                        <button class="btn btn-danger" name="status" value="missed">✘ Missed</button>
                    </td>
                </form>

                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include_once('../components/user_footer.php') ?>


</body>
<script>

</script>

</html>