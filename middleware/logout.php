<?php
session_start();
session_destroy();
header('location:http://localhost/namazapp/pages/login.php');
 ?>