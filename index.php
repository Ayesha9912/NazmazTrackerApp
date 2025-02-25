<?php
session_start(); 
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
      <link rel="stylesheet" href="./assets/style/fronted.css?v=<?php echo time(); ?>">
</head>
<body>

<!-- Header Section -->
<?php include_once('./components/user_header.php') ?>

<!-- Main Content -->
<section class="banner position-relative text-center text-white">
    <img src="assets/images/sultan-qaboos-grand-mosque-5963726_1920.jpg" class="img-fluid w-100" alt="Namaz Banner">
    <div class="overlay position-absolute top-50 start-50 translate-middle text-center">
        <h1 class="fw-bold">The Importance of Namaz</h1>
        <p class="lead">Strengthen your connection with Allah through prayer</p>
        <a href="pages/user_dashboard.php" class="btn btn-light btn-lg mt-3">Mark Prayers Now!</a>
        
    </div>
</section>


<!-- Importance of Namaz Section -->
<div class="container content">
    <div class="row align-items-center importance-section">
        <div class="col-md-6">
            <img src="assets/images/sultan-qaboos-grand-mosque-5963726_1920.jpg" class="img-fluid shadow-lg" alt="Namaz Importance">
        </div>
        <div class="col-md-6">
            <h2 class="text-primary">Importance of Namaz</h2>
            <p class="lead">
                Namaz (Salah) is one of the five pillars of Islam and is a means of connecting with Allah. 
                It brings peace to the heart, discipline to life, and spiritual purity to the soul.
                Namaz (Salah) is one of the five pillars of Islam and serves as a direct link between a believer and Allah. It is an essential act of worship that fosters spiritual, mental, and physical discipline. Performing Namaz five times a day helps Muslims maintain a strong connection with their Creator, seek His guidance, and purify their souls.
            </p>
            <p>
                The Holy Quran emphasizes the significance of prayer: 
                <b>“Indeed, prayer prohibits immorality and wrongdoing.”</b> (Quran 29:45)
            </p>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include_once('./components/user_footer.php') ?>
<!-- 
<script>
    // Auto-update year
    document.getElementById("year").textContent = new Date().getFullYear();
</script> -->

</body>
</html>
