<?php
if ($_SESSION['admin_name'] !== 'admin') {
    $select_admin = $conn->prepare('SELECT * FROM `admin` WHERE name = ?');
    $select_admin->execute([$_SESSION['admin_name']]);
    $row = $select_admin->fetch(PDO::FETCH_ASSOC);
    $password = $row['pass'];
}





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register_admin'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare('SELECT * FROM `admin` WHERE email = ?');
        $select_admin->execute([$email]);

        if ($select_admin->rowCount() > 0) {
            $error[] = "Admin Already registered";
        } else {
            $register_admin = $conn->prepare('INSERT INTO `admin`  (name , email, pass) VALUES (?,?,?)');
            $register_admin->execute([$name, $email, $pass]);
            $msg[] = "Admin registered!";
        }

    }
    /////////Deleting the Admin//////////////////
    if (isset($_POST['delete_admin'])) {
        $id = $_POST['id'];
        echo $id;
        $delete_admin = $conn->prepare('DELETE FROM `admin` WHERE id = ?');
        $delete_admin->execute([$id]);
        $error[] = 'The admin is successfully Deleted';
    }
    ////Update the admin////////////////////////
    if (isset($_POST['update_user'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $new_pass = sha1($_POST['new_pass']);
        $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

        $id = $_POST['id'];

        $prev_pass = $_POST['pass'];
        $pass = sha1($_POST['prev_pass']);
        $pass = filter_var($pass , FILTER_SANITIZE_STRING);
        if($pass != $prev_pass){
            $error[] = 'Your Previous Password does not match';
        }else{
            $update_profile = $conn->prepare('UPDATE `admin` SET name = ? AND pass = ? WHERE id = ?');
            $update_profile->execute([$name ,  $new_pass , $id]);
            $msg[] = "Profile is updated successfully";

        }
        

    }

}

// ///////deleting the user//////////////////////////////
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(isset($_POST['delete_user'])){
       $id = $_POST['id'];
       $delete_admin = $conn->prepare('DELETE FROM `users` WHERE id = ?');
       $delete_admin->execute([$id]);
       $msg[] = 'The users is successfully Deleted';
    
    }
}


function get_admins($conn)
{
    $get_admins = $conn->prepare('SELECT * FROM `admin`');
    $get_admins->execute();
    return $get_admins; // Return the PDOStatement
}

function get_users($conn){
    $get_users = $conn->prepare('SELECT * FROM `users`');
    $get_users->execute();
    return $get_users;
}




?>