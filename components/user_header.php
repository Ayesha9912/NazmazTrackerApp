<?php
// if(isset($_SESSION['user_login'])){
//     echo $_SESSION['user_login'];
// }else{
//     echo 'session has not started';
// }
?>
<nav class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="http://localhost/namazapp"><i class="fa-solid fa-mosque"></i> Prayer
            Tracker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="http://localhost/namazapp"><i class="fa-solid fa-house"></i>
                        Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/namazapp/pages/reports.php"><i
                            class="fa-solid fa-chart-bar"></i> Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/namazapp/pages/qaza.php"><i class="fa-solid fa-file"></i>
                        Qaza Page</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user-circle size-5"></i>
                        <?php if (isset($_SESSION['id'])) { ?>
                            <span class="text-light"><?= $_SESSION['name']; ?></span>
                            <?php
                        } ?>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-muted" href="#">
                                <?php if (isset($_SESSION['id'])) { ?>
                                    <i class="fa-solid fa-user"></i> <?= $_SESSION['name'] ?></a></li>
                            <?php
                                } else { ?>
                            <i class="fa-solid fa-user"></i>Username</a>
                    </li>
                    <?php

                                } ?>

                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="http://localhost/namazapp/pages/login.php"><i
                            class="fa-solid fa-sign-in-alt"></i> Login</a></li>
                <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-sign-out-alt"></i>
                        Logout</a></li>
                <li><a class="dropdown-item text-primary fw-bold" href="http://localhost/namazapp/pages/register.php"><i
                            class="fa-solid fa-user-plus"></i> Register</a></li>
            </ul>
            </li>
            </ul>
        </div>
    </div>
</nav>